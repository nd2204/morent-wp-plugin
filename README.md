<!-- Improved compatibility of back to top link: See: https://github.com/othneildrew/Best-README-Template/pull/73 -->
<a id="readme-top"></a>

<!-- PROJECT SHIELDS -->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Issues][issues-shield]][issues-url]
[![project_license][license-shield]][license-url]

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <!-- <a href="https://github.com/nd2204/morent-wp-plugin">
    <img src="docs/logo.png" alt="Logo" width="80" height="80">
  </a> -->

  <h3 align="center"></h3>

  <p align="center">
    Morent client for wordpress
    <br />
    <a href="https://github.com/nd2204/morent-wp-plugin"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/nd2204/morent-wp-plugin">View Demo</a>
    &middot;
    <a href="https://github.com/nd2204/morent-wp-plugin/issues/new?labels=bug&template=bug-report---.md">Report Bug</a>
    &middot;
    <a href="https://github.com/nd2204/morent-wp-plugin/issues/new?labels=enhancement&template=feature-request---.md">Request Feature</a>
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->
<!-- ## About The Project -->


<!-- GETTING STARTED -->
## Getting Started


### Prerequisites

- [Wordpress][Wordpress] (6.x)
- [Docker](https://www.docker.com/) with compose or [Xampp](https://www.apachefriends.org/)

### Installation

There are two main way to setting up the development environment for this project, either by using open source web server stack package like Xampp or by using our Docker solution. 

#### Using Docker (Recommended)

1. Clone the repo

   ```sh
   git clone https://github.com/nd2204/morent-wp-plugin.git
   cd morent-wp-plugin
   ```

2. Download and extract [wordpress][Wordpress] to current directory

   ```sh
   curl https://wordpress.org/latest.zip -o wordpress.zip
   unzip wordpress.zip
   rm wordpress.zip
   ```

3. Run docker compose

   ```sh
   docker-compose up -d
   ```

#### Using Xampp

1. Clone the repo

   ```sh
   cd C:\xampp\htdocs\
   git clone https://github.com/nd2204/morent-wp-plugin.git
   ```

2. Link morent-wp to plugins directory

- For MacOs the directory should be at `/Applications/XAMPP/htdocs`
- For Linux the directory should be at `/opt/lampp/htdocs`

   ```sh
   # Link using absolute path (recommended)
   mklink \D Absolute\path\to\morent-wp-plugin C:\xampp\htdocs\wp-content\plugins\morent-wp-plugin
   ```

<p align="right"><a href="#readme-top">back to top</a></p>

<!-- USAGE EXAMPLES -->
<!-- ## Usage

Use this space to show useful examples of how a project can be used. Additional screenshots, code examples and demos work well in this space. You may also link to more resources.

_For more examples, please refer to the [Documentation](https://example.com)_

<p align="right"><a href="#readme-top">back to top</a></p>

See the [open issues](https://github.com/nd2204/morent-wp-plugin/issues) for a full list of proposed features (and known issues).

<p align="right"><a href="#readme-top">back to top</a></p> -->

<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are **greatly appreciated**.

If you have a suggestion that would make this better, please fork the repo and create a pull request. You can also simply open an issue with the tag "enhancement".
Don't forget to give the project a star! Thanks again!

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

<p align="right"><a href="#readme-top">back to top</a></p>

### Top contributors

<a href="https://github.com/nd2204/morent-wp-plugin/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=nd2204/morent-wp-plugin" alt="contrib.rocks image" />
</a>

<!-- LICENSE -->
## License

Distributed under the MIT license. See `LICENSE.txt` for more information.

<p align="right"><a href="#readme-top">back to top</a></p>

<!-- CONTACT -->
<!-- ## Contact -->

<!-- Your Name - [@twitter_handle](https://twitter.com/twitter_handle) - email@email_client.com -->

<!-- Project Link: [https://github.com/nd2204/morent-wp-plugin](https://github.com/nd2204/morent-wp-plugin) -->

<!-- <p align="right">(<a href="#readme-top">back to top</a>)</p> -->

<!-- ACKNOWLEDGMENTS -->
<!-- ## Acknowledgments -->

<!-- * []() -->
<!-- * []() -->
<!-- * []() -->

<!-- <p align="right">(<a href="#readme-top">back to top</a>)</p> -->

<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/nd2204/morent-wp-plugin.svg?style=for-the-badge
[contributors-url]: https://github.com/nd2204/morent-wp-plugin/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/nd2204/morent-wp-plugin.svg?style=for-the-badge
[forks-url]: https://github.com/nd2204/morent-wp-plugin/network/members
[issues-shield]: https://img.shields.io/github/issues/nd2204/morent-wp-plugin.svg?style=for-the-badge
[issues-url]: https://github.com/nd2204/morent-wp-plugin/issues
[license-shield]: https://img.shields.io/github/license/nd2204/morent-wp-plugin.svg?style=for-the-badge
[license-url]: https://github.com/nd2204/morent-wp-plugin/blob/master/LICENSE.txt
[Wordpress]: https://wordpress.org/download