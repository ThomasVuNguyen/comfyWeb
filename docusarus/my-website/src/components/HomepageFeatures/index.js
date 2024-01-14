import clsx from 'clsx';
import Heading from '@theme/Heading';
import styles from './styles.module.css';
import GestureButton from '/static/img/gesture-button.gif';
import LED from '/static/assets/Button/LED.gif';
const FeatureList = [
  {
    img: GestureButton,
    
    title: 'Gesture-based control',
    Svg: require('@site/static/img/zero-setup.svg').default,
    
    description: (
      <>
        Modern gestures can be used to execute any commands: swipe, tap, toggle, ... or even voice!
      </>
    ),
  },

  {
    title: 'Component-specific control',
    img: LED,
    Svg: require('@site/static/img/zero-setup.svg').default,
    description: (
      <>
      Great for time saving & testing
      </>
    ),
  },
  {
    title: 'Ease of development',
    Svg: require('@site/static/img/simple-stable.svg').default,
    description: (
      <>
        ComfySpace is designed from ground up to provide a minimal setup & development experience
      </>
    ),
  },
  {
    title: 'Time saving for makers',
    Svg: require('@site/static/img/time-savin.svg').default,
    description: (
      <>
      ComfyScript can be used to control any Raspberry Pi component in 1 line of code. You can still use your programming language of choice, of course
      </>
    ),
  },
  {
    title: 'Cross-platform',
    Svg: require('@site/static/img/cross-platform.svg').default,
    description: (
      <>
        ComfySpace is now available on Windows, MacOS & Android! Coming soon to iOS & Linux.
      </>
    ),
  },
];

function Feature({Svg, title, description, img}) {
  return (
    <div className={clsx('col col--4')}>
      <div className="text--center">
        <img src={img} className={styles.featureImg}></img>
        {/*
        <Svg className={styles.featureSvg} role="img" />
        */}
      </div>
      <div className="text--center padding-horiz--md">
        <Heading as="h3">{title}</Heading>
        <p>{description}</p>
      </div>
    </div>
  );
}

export default function HomepageFeatures() {
  return (
    <section className={styles.features}>
      <div className="container">
        <div className="row">
          {FeatureList.map((props, idx) => (
            <Feature key={idx} {...props} />
          ))}
        </div>
      </div>
    </section>
  );
}
