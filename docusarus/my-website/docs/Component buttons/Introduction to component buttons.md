import DistanceSensor from '../../static/assets/Button/Distance_Sensor.gif';

import StepperMotor from '../../static/assets/Button/Stepper_Motor.gif';

import LED from '../../static/assets/Button/LED.gif';

# Component-specific buttons

As the name implies, these are buttons specific to a certain component (LED, motor, sensor)

This is great for simple projects!
***And saves you so much time when prototyping and testing***

<details>
    <summary>LED button</summary>
<p>
A toggle button to turn an LED on/off
Press +, enter the GPIO pin used to power the LED, press done.

<img src={LED} width="360"></img>
</p>
</details>

<details>
    <summary>Stepper Motor button</summary>
<p>
Controlling your Stepper Motor with a swiping gesture.

Press +, enter the GPIO pin used to power the Stepper Motor, press done.

Put pic here

Swipe left to rotate counterclockwise, swipe right to rotate clockwise, and tap to stop any rotation.
<img src={StepperMotor} width="360"></img>
</p>
</details>

<details>
    <summary>DC Motor button</summary>
<p>
Controlling your DC Motor (with L298 controller) with a swiping gesture.

Press +, enter the GPIO pin used to power the DC Motor, press done.

Put pic here

Swipe left to rotate counterclockwise, swipe right to rotate clockwise, and tap to stop any rotation.
</p>
</details>

<details>
    <summary>Distance sensor button</summary>
<p>
Displaying information from distance sensor (HC-SR04) in real time.

Press +, enter the GPIO pin used to control the distance sensor, press done.

Put pic here

You can now see the sensor reading in real time.
</p>
<img src={DistanceSensor} width="360"></img>
</details>