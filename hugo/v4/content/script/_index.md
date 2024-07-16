---
title: ComfyScript
description: A scripting language to make controlling robots as simple as spoken English
img: https://github.com/ThomasVuNguyen/comfyScript/raw/main/assets/icon.png
general_description: Below is how you can control common robotics components using ComfyScript. No more 100+ lines of Python codes.
components:
    - name: LED
      img: https://cdn-shop.adafruit.com/970x728/4203-04.jpg
      description: LED (light emitting diode) lights up when there's power. Comes in variety of colors
      joke: The ultimate starter component for all robotics enthuiasts👌
      code: 
        - text: comfy led {pin} {state}
          note: This command is used to turn on or off an led.
          explain:
            - text: "{pin} stands for the GPIO pin attached to the + side of the LED."
            - text: "{state} represents the on/off state of the led. {state} has 2 values of 1 & 0 for On & Off, respectively."
        - text: comfy led 11 1
          note: For example, his turns an LED attached to pin 11 on

        - text: comfy led 12 0
          note: For example, this command turns an LED attached to pin 12 off

    - name: DC Motor
      img: https://m.media-amazon.com/images/I/41fqVNAbQ6L._SY445_SX342_QL70_FMwebp_.jpg
      description: DC motors create motions (clockwise or counter-clockwise) when powered. This is meant to be used with an L298N controller. DC Motor is used to generate fast & continuous motion, useful for RC car wheels & anything that spins fast.
      joke: My favorite component 😋
      code:
        - text: comfy dc {pin+} {pin-} {state+} {state-}
          note: This command is used to control a single DC motor attached to a L298N 
          explain:
            - text: "{pin+} & {pin-} represents the GPIO pins connected to the + & - sides of the DC motor."
            - text: "{state+} & {state-} are used to control the direction in which the motor rotates. These both have 2 values 0 & 1, representing off & on."
        - text: comfy dc 23 24 1 0
          note: For example, this command will turn a DC motor (attached to pins 23 & 24) clockwise
        - text: comfy dc 23 24 0 0
          note: For example, this command will turn a DC motor (attached to pins 23 & 24) off
        - text: comfy dc 23 24 0 1
          note: For example, this command will turn a DC motor (attached to pins 23 & 24) counter-clockwise

    - name: Stepper Motor
      img: https://cdn-shop.adafruit.com/970x728/918-03.jpg
      description: Stepper motors are motors that spin to very accurate angles. This is useful for applications requiring accurate movements such as conveyor belts, turning system for RC cars, etc.
      joke: Your 3D printer has at least 3 of these 🏍️💨
      code: 
        - text: comfy stepper {pin1} {pin2} {pin3} {pin4} {direction}
          note: This command is used to control the direction of the stepper motor movement.
          explain: 
            - text: "{pin1} to {pin4} are the GPIO pins used to control the stepper motor. "
            - text: "{direction} represents rotational direction. {direction} has 3 values: -1, 0, 1 for counter-clockwise, stop, clockwise."
        - text: comfy stepper 23 24 22 27 1
          note: For example, this command is used to control the stepper motor attached to pins 23, 24, 22, 27 to move clockwise

    - name: Temperature & humidity sensor
      img: https://www.electronicwings.com/storage/PlatformSection/TopicContent/119/icon/DHT11%20New.jpg
      description: DHT sensors provide reading of temperature & humidity. Currently supported sensors include DHT 11, 22 & 2302 (which is like... all of 'em).
      joke: "Side note: this won't break no matter how much you break 'em 🔥"
      code:
        - text: comfy dht_temp {sensor type} {pin}
          note: This command returns temperature reading.
          explain:
            - text: "{sensor type} stands for the DHT sensor type. This has 3 values 11, 22 & 2302."
            - text: "{pin} stands for the GPIO pin which the DHT sensor is connected to."
        - text: comfy dht_temp 11 13
          note: For example, this command returns temperature reading from sensor type DHT11 & attached to pin 13.
        - text: comfy dht_humid {sensor type} {pin}
          note: This command returns humidity reading.
          explain:
            - text: "{sensor type} stands for the DHT sensor type. This has 3 values 11, 22 & 2302."
            - text: "{pin} stands for the GPIO pin which the DHT sensor is connected to."
        - text: comfy dht_humid 22 15
          note: For example, this command returns temperature reading from sensor type DHT22 & attached to pin 15.

    - name: Distance sensor
      video: https://cdn-shop.adafruit.com/product-videos/1024x768/3942-04.mp4
      description: The HC-SR04 sensor is widely used to measure distance. Small, cheap & versatile. All things should be like this, don't you agree?
      joke: This works using sonic btw 😎
      code:
        - text: comfy distance {trigger} {echo} {state}
          note: This command returns the distance reading.
          explain:
            - text: "{trigger} & {echo} stands for the GPIO pins connected to the sensor."
            - text: "{state} has 2 values 0 & 1, used to turn the sensor off & on accordingly"
        - text: comfy distance 22 23 1
          note: For example, this command returns distance sensor reading from a sensor connected to pins 22 & 23.
        - text: comfy distance 22 23 0
          note: This command turns the sensor off (to save energy & the planet in the process... probably).

    - name: Gemini (Google AI)
      img: https://storage.googleapis.com/gweb-uniblog-publish-prod/images/IO24_WhatsInAName_Hero_1.width-1200.format-webp.webp
      description: Yep, you're reading it right! ComfyScript has Gemini AI chat built-in. We built this with convenience & simplicity in mind.
      joke: AI is everywhere nowaday, might as well take a piece 💸
      code: 
        - text: comfy gemini_setup {api}
          note: This command is used to setup your API key. Meant to run once per Raspberry Pi.
          explain:
            - text: "{api} stands for the Google Gemini API."
            - text:  Don't worry, Google Gemini has a generous free tier.

        - text: comfy gemini_run {prompt}
          note: This command returns a response from Gemini.
          explain: 
            - text: "{prompt} stands for your prompt/question to the AI!"
            - text: Don't ask anything explicitly sexual. I mean it!

usage: 
  - name: Launch ahead!
    description: The app looks much better than in the picture, btw! ✌
    url: /download
    img: /homepage/remote-control.png

github:
  - part: Built with love
    creator: Thomas the Maker 💘 
    type: Github
    img: https://github.com/ThomasVuNguyen/comfyScript/raw/main/assets/icon.png
    url: https://github.com/ThomasVuNguyen/comfyScript
  
        

  

---
{{<documentation>}}