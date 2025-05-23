<?php

require_once MR_INCLUDE_DIR . 'api-client.php';

$authApi = new MorentApiClient()->AuthApi();

function mr_is_logged_in() {
    return isset($_SESSION['Morent_user']);
}

function mr_logout() {
    global $authApi;

    try {
        $authApi->apiAuthLogoutPost();
    } catch (Exception $e) {
        echo "<script>location.href='" . admin_url('admin.php?page=morent_login') . "'</script>";
    }

    if (function_exists('delete_option')) {
        delete_option(MorentApiClient::$access_token_option);
        delete_option(MorentApiClient::$refresh_token_option);
    }
    unset($_SESSION['Morent_user']);
    session_destroy();

    // Redirect to morent login
    if (function_exists('wp_safe_redirect')) {
        wp_redirect(admin_url('admin.php?page=morent_login'));
        die;
    }
}

add_action('init', function () {
    if (!session_id()) session_start();
});

function get_page_callback($filename)
{
    if (!mr_is_logged_in()) {
        return get_template_page_callback("login-form");
    } else {
        return get_template_page_callback($filename);
    }
}

function get_template_page_callback($filename)
{
    return function () use ($filename) {
        $path = MR_TEMPLATES_DIR . $filename . '.php';
        if (file_exists($path)) {
            include $path;
        } else {
            echo "<div class='notice notice-error'><p>File not found: {$filename}.php</p></div>";
        }
    };
}

function summarizeMonthlyRentals(array $rentals): array {
    // Initialize result with all months set to zero
    $monthlySummary = [];
    foreach (range(1, 12) as $month) {
        $monthName = date('M', mktime(0, 0, 0, $month, 1));
        $monthlySummary[$monthName] = ['revenue' => 0, 'rentals' => 0];
    }

    foreach ($rentals as $rental) {
        if (!($rental['created_at'] instanceof \DateTime)) {
            continue; // Skip if date is invalid
        }

        $monthName = $rental['created_at']->format('M');

        $monthlySummary[$monthName]['revenue'] += $rental['total_cost'];
        $monthlySummary[$monthName]['rentals'] += 1;
    }

    return $monthlySummary;
}

function summarizeDailyRentals(array $rentals): array {
    $summary = [];

    $startOfMonth = new \DateTime('first day of this month');
    $endOfMonth = new \DateTime('last day of this month');

    // Initialize every day in the month
    $current = clone $startOfMonth;
    while ($current <= $endOfMonth) {
        $day = $current->format('Y-m-d');
        $summary[$day] = ['revenue' => 0, 'rentals' => 0];
        $current->modify('+1 day');
    }

    // Populate data
    foreach ($rentals as $rental) {
        $date = $rental->getCreatedAt();
        if (!$date instanceof \DateTime) continue;

        $day = $date->format('Y-m-d');
        if (isset($summary[$day])) {
            $summary[$day]['revenue'] += $rental->getTotalCost();
            $summary[$day]['rentals'] += 1;
        }
    }

    ksort($summary);
    return $summary;
}


function summarizeWeeklyRentals(array $rentals): array {
    $summary = [];

    $startOfMonth = new \DateTime('first day of this month');
    $endOfMonth = new \DateTime('last day of this month');
    $labelPrefix = $startOfMonth->format('F Y');

    // Initialize 5 weeks max (week 1 = days 1–7, etc.)
    for ($week = 1; $week <= 5; $week++) {
        $label = "$labelPrefix - Week $week";
        $summary[$label] = ['revenue' => 0, 'rentals' => 0];
    }

    // Populate data
    foreach ($rentals as $rental) {
        $date = $rental->getCreatedAt();
        if (!$date instanceof \DateTime) continue;

        if ($date < $startOfMonth || $date > $endOfMonth) continue;

        $dayOfMonth = (int) $date->format('j');
        $weekOfMonth = min(5, (int)ceil($dayOfMonth / 7));
        $label = "$labelPrefix - Week $weekOfMonth";

        $summary[$label]['revenue'] += $rental->getTotalCost();
        $summary[$label]['rentals'] += 1;
    }

    ksort($summary);
    return $summary;
}

function getCarTypesCount(array $rentals, callable $getTypes): array {
    $typeCounts = [];
    // Count rentals by type
    foreach ($rentals as $rental) {
        $type = $getTypes($rental) ?? 'Unknown';

        if (!isset($typeCounts[$type])) {
            $typeCounts[$type] = 0;
        }

        $typeCounts[$type]++;
    }

    arsort($typeCounts);
    return $typeCounts;
}