// @ts-check
// `@type` JSDoc annotations allow editor autocompletion and type checking
// (when paired with `@ts-check`).
// There are various equivalent ways to declare your Docusaurus config.
// See: https://docusaurus.io/docs/api/docusaurus-config

import {themes as prismThemes} from 'prism-react-renderer';

/** @type {import('@docusaurus/types').Config} */
const config = {
  title: 'Comfy Space',
  tagline: 'Raspberry Pi development simplified',
  favicon: 'img/favicon.ico',

  // Set the production url of your site here
  url: 'https://fascinating-kheer-7bc779.netlify.app/',
  // Set the /<baseUrl>/ pathname under which your site is served
  // For GitHub pages deployment, it is often '/<projectName>/'
  baseUrl: '/',

  // GitHub pages deployment config.
  // If you aren't using GitHub pages, you don't need these.
  organizationName: 'Thomas Nguyen', // Usually your GitHub org/user name.
  projectName: 'Comfy Space doc', // Usually your repo name.

  onBrokenLinks: 'throw',
  onBrokenMarkdownLinks: 'warn',

  // Even if you don't use internationalization, you can use this field to set
  // useful metadata like html lang. For example, if your site is Chinese, you
  // may want to replace "en" with "zh-Hans".
  i18n: {
    defaultLocale: 'en',
    locales: ['en'],
  },

  presets: [
    [
      'classic',
      /** @type {import('@docusaurus/preset-classic').Options} */
      ({
        docs: {
          sidebarPath: './sidebars.js',
          // Please change this to your repo.
          // Remove this to remove the "edit this page" links.
        },
        blog: {
          showReadingTime: true,
          // Please change this to your repo.
          // Remove this to remove the "edit this page" links.
        },
        theme: {
          customCss: './src/css/custom.css',
        },
      }),
    ],
  ],

  themeConfig:
    /** @type {import('@docusaurus/preset-classic').ThemeConfig} */
    ({
      // Replace with your project's social card
      image: 'img/rpi-social-card.jpg',
      navbar: {
        title: 'Comfy Doc',
        logo: {
          alt: 'Comfy Logo',
          src: 'img/logo.svg',
        },
        items: [
          {
            type: 'docSidebar',
            sidebarId: 'tutorialSidebar',
            position: 'left',
            label: 'Documentation',
          },
          {to: '/blog', label: 'Blog', position: 'left'},
          {
            href: '/docs/Download',
            label: 'Download',
            position: 'right',
          },

        ],
      },
      footer: {
        style: 'dark',
        links: [
          {
            title: 'Docs',
            items: [
              {
                label: 'Documentation',
                to: '/docs/First%20setup',
              },
            ],
          },
          {
            title: 'Community',
            items: [
              {
                label: 'Reddit',
                href: 'https://www.reddit.com/r/ComfySpace/',
              },
            ],
          },
          {
            title: 'Comfy Github repositories',
            items: [
              {
                label: 'ComfySpace',
                href: 'https://github.com/ThomasVuNguyen/comfySpace',
              },
              {
                label: 'ComfyScript',
                href: 'https://github.com/ThomasVuNguyen/comfyScript',
              },
              {
                label: 'ComfyShare',
                href: 'https://github.com/ThomasVuNguyen/comfyShare',
              },
              {
                label: 'ComfyRobo',
                href: 'https://github.com/ThomasVuNguyen/comfyRobo',
              },
              
            ],
          },
          {
            title: 'More',
            items: [
              {
                label: 'Blog',
                to: '/blog',
              },
              {
                label: 'Thomas Nguyen',
                to: 'https://tungnguyen.me/',
              },
            ],
          },
        ],
        copyright: `Copyright © ${new Date().getFullYear()} ComfyStudio & built with Docusaurus.`,
      },
      prism: {
        theme: prismThemes.github,
        darkTheme: prismThemes.dracula,
      },
    }),
};

export default config;
