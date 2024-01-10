import clsx from 'clsx';
import Heading from '@theme/Heading';
import styles from './styles.module.css';

const FeatureList = [
  {
    title: 'Gesture-based control',
    Svg: require('@site/static/img/zero-setup.svg').default,
    description: (
      <>
        Controlling your Raspberry Pi with swipe, tap, and toggle
      </>
    ),
  },
  {
    title: 'Zero setup',
    Svg: require('@site/static/img/zero-setup.svg').default,
    description: (
      <>
        ComfySpace (the application) and ComfyScript (API & library) have been designed so that there is that no setup on your end.
        It's all automatic!
      </>
    ),
  },
  {
    title: 'Simple and stable',
    Svg: require('@site/static/img/simple-stable.svg').default,
    description: (
      <>
        Create a button, bind it to a component or command. Done!
      </>
    ),
  },
  {
    title: 'Time saving for makers',
    Svg: require('@site/static/img/time-savin.svg').default,
    description: (
      <>
        Instead of writing your own 100-line long python scripts. Write <code>python3 comfyScript/component pin state</code> to control any components
      </>
    ),
  },
  {
    title: 'Cross-platform',
    Svg: require('@site/static/img/cross-platform.svg').default,
    description: (
      <>
        ComfySpace is now available on Windows & Android! Coming soon to iOS, MacOS, and Linux. Potentially web also!
      </>
    ),
  },
];

function Feature({Svg, title, description}) {
  return (
    <div className={clsx('col col--4')}>
      <div className="text--center">
        <Svg className={styles.featureSvg} role="img" />
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
