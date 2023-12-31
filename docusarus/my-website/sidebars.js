/**
 * Creating a sidebar enables you to:
 - create an ordered group of docs
 - render a sidebar for each doc of that group
 - provide next/previous navigation

 The sidebars can be generated from the filesystem, or explicitly defined here.

 Create as many sidebars as you want.
 */

// @ts-check

/** @type {import('@docusaurus/plugin-content-docs').SidebarsConfig} */
const sidebars = {
  // By default, Docusaurus generates a sidebar from the docs folder structure
  //tutorialSidebar: [{type: 'autogenerated', dirName: '.'}],

  
  tutorialSidebar: [
    //'Quick start',
    'First setup',
    'Create a space',
    'Add buttons',
    'Component specific buttons',
    'Custom buttons',
    'Download',
    'FAQ',
    /*
    {
      type: 'category',
      label: 'Component buttons',
      items: [
        'Component buttons/Introduction to component buttons',
        'Component buttons/LED',
        'Component buttons/Stepper Motor',
        'Component buttons/Distance sensor',
        'Component buttons/DC Motor',
      ],
    },
    {
      type: 'category',
      label: 'Custom buttons',
      items: [
        'Custom buttons/Introduction to custom buttons',
        'Custom buttons/Press button',
        'Custom buttons/Toggle button',
        'Custom buttons/Gesture control buttons',
        'Custom buttons/Data read button',
      
      ],
    },*/
  ],
   
};

export default sidebars;
