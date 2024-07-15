---
title: ComfyScript
description: A scripting language to make controlling robots as simple as spoken English
img: https://github.com/ThomasVuNguyen/comfyScript/raw/main/assets/icon.png
general_description: Below is how you can control common robotics components using ComfyScript.
components:
    - name: LED
      img: https://cdn-shop.adafruit.com/970x728/4203-04.jpg
      description: LED (light emitting diode) lights up when there's power. Comes in variety of colors
      nickname: The ultimate starter component
      code: 
        - text: comfy led {pin} {state}
          note: This command is used to turn on or off an led.

        - text: comfy led 11 1
          note: For example, his turns an LED attached to pin 11 on

        - text: comfy led 12 0
          note: For example, this command turns an LED attached to pin 12 off

    - name: DC Motor
      img: https://m.media-amazon.com/images/I/41fqVNAbQ6L._SY445_SX342_QL70_FMwebp_.jpg
      description: DC motors create motions (clockwise or counter-clockwise) when powered. This is meant to be used with an L298N controller.
      code:
        - text: comfy dc {pin+} {pin-} {state+} {state-}
          note: This command is used to control a single DC motor attached to a L298N 
        - text: comfy dc 23 24 1 0
          note: Example, this command will turn a DC motor (attached to pins 23 & 24) clockwise
        - text: comfy dc 23 24 0 0
          note: Example, this command will turn a DC motor (attached to pins 23 & 24) off
        - text: comfy dc 23 24 0 1
          note: Example, this command will turn a DC motor (attached to pins 23 & 24) counter-clockwise
        

---
{{<documentation>}}