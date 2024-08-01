---
title: A simple guide to power your robots
description: Like humans, robots need energy to function. In this lesson, we'll explore the basics of powering robots with options like power supplies and batteries. By the end, you'll confidently choose a power source for your project.
img: https://cdn.thewirecutter.com/wp-content/media/2022/08/rechargeable-battery-2048px-5922.jpg?auto=webp&quality=75&width=1024&dpr=2
img_note: Image credit to the NYTimes

content:
    - name: Battery specification fundamentals
      description: If you flip over a battery, you will find specifications such as voltage & power like below....
      img: /learn/battery/battery-spec.png
    - description: What do these mean?
    - description: V stands for Volt, the unit of Voltage. Common power sources, such as batteries and power supplies, typically provide 3-12V.
      note: Make sure your robots components have the same voltage as the power supply
    - description: For reference, DC motors often use 3V, smartphones typically operate on 5V, and desktop monitors usually require 12V.
      note: Often in a robot, you will have components with different voltage requirements. Refer to Buck Converter below for this case.
    - img: https://thepihut.com/cdn/shop/products/18650-lithium-ion-rechargeable-cell-3000mah-3-7v-15a-the-pi-hut-105184-38522899923139_1000x.jpg?v=1658855698

    - description: mWh stands for milli-Watt-hour, the unit for Energy. This shows how much energy there is in a fully charged battery.
    - description: You might know of the unit mAh (milli-amp-hour). To find mWh, use the formula below.
      note: mAh * V = mWh
    
    - name: Power supply (a well-rounded choice)
      description: The oldest, most reliable, powerful & affordable option for any robotics project.
    - description: Compared to batteries, this provives virtually unlimited power from the mighty wall outlet.
      img: /learn/battery/power-supply.png
      note: Best option if portability is not a requirements
    
    - name: Rechargable AA & AAA batteries (personal favorite)
    - name: AA & AAA batteries
    - name: Lipo batteries
    - name: "18650 cell batteries"
    - name: RC Lipo batteries



final_words:
    note: Batteries can be complex and, if mishandled, dangerous. This guide aims to simplify battery selection for various use cases, making the process easier and more enjoyable for robot builders. It is regularly updated with new information. For discussions or questions, join our Discord channel below!
    


---
{{<learn>}}