---
title: "Playcar"
description: "RC cars are fun but hard to build. Not this one!"
altImg: "image of playcar causing havoc"
img: ""
components:
    - name: Raspberry Pi Zero 2W
      img: https://www.cnx-software.com/wp-content/uploads/2021/10/Raspberry-Pi-Zero-2-W-board.jpg
      description: Small but mighty. Packed with plenty computing power, this bad boy controls are of the motor operations.
      quantity: 1
      price: 15$

    - name: LM2596 Buck Converter
      img: https://www.az-delivery.de/cdn/shop/products/lm2596s-step-down-dc-dc-buck-converter-mit-3-stelliger-digitalanzeige-976017_grande.jpg?v=1679398935
      description: Regulates voltage from the AA batteries to power the Raspberry Pi
      quantity: 1
      price: 5$

    - name: DC Motor
      img: https://m.media-amazon.com/images/I/61JtBdEdKYL._SL1500_.jpg
      description: This is the horsepower for Playcar. Cheap but packs a punch. 
      quantity: 2
      price: 1.5$

    - name: L298N Motor Controller
      img: https://m.media-amazon.com/images/I/61mtDsHOn9L.jpg
      description: Motors are naturally dumb. This helps the Raspberry Pi "talk" to the motors more effectively.
      quantity: 1
      price: 5.5$

    - name: AA batteries
      img: https://www.zerotoys.com/v/vspfiles/photos/BattAA-06-2.jpg?v-cache=1611577815
      description: Yes, Playcar runs on AA batteries. You can buy a pack with your eyes closed.
      quantity: 6-pack
      price: 2.5$

    - name: AA battery holders
      img: https://m.media-amazon.com/images/I/71-WxRwS8uL._AC_SX679_.jpg
      description: You only need a set of holders for 4 & 2 AA batteries. But they only sell a pack on Amazon.
      quantity: 1
      price: 7$
     
    - name: Jumper Wires
      img: https://m.media-amazon.com/images/I/71wNuDUZGEL._SX522_.jpg
      description: These are easy to use cables to create electrical connections. TLDR - jumper cables make car goes brrr. A pack will last you 10 projects
      quantity: 1
      price: 7$

    - name: Screws
      img: https://www.harborfreight.com/media/catalog/product/cache/9fc4a8332f9638515cd199dd0f9238da/i/m/image_20117.jpg
      description: Wood screws (because they're cheap) to assemble parts together. A pack will last you years worth of projects.
      quantity: 1
      price: 5$ 
    
    - name: Butt Connectors
      img: https://www.harborfreight.com/media/catalog/product/cache/9fc4a8332f9638515cd199dd0f9238da/i/m/image_20121.jpg
      description: Used to connect wires together. Great & cheap alternatives to soldering. If you already have a soldering iron & solder, you can skip this.
      quantity: 1
      price: 12$

tools:
    - name: 3D Printer
      img: https://www.cnet.com/a/img/resize/743440ccfdec25dda93319ad4f362ae162bfffd0/hub/2022/09/06/f166bd01-ea0b-499f-bdc9-7d156e8e5cce/img-2138.jpg?auto=webp&width=1200
      description: This helps print the body of Playcar. A 150$ Ender-3 printer can last for years (at least mine does).
    
    - name: Wire Stripper
      img: https://www.harborfreight.com/media/catalog/product/cache/9fc4a8332f9638515cd199dd0f9238da/9/8/98410_W3.jpg
      description: Used to cut & strip wires. My 6$ wire stripper is two year old & still working fine.
    
    - name: Screw Driver Set
      img: https://i5.walmartimages.com/seo/Hyper-Tough-44-Piece-Precision-Multi-type-Screwdriver-Bits-Set-TS99913A_f23c0e46-f267-48d5-87fe-17ea92e2884f.72e98357c6fd8c95fd22e454cff128cc.jpeg?odnHeight=2000&odnWidth=2000&odnBg=FFFFFF
      description: Nothing fancy, a cheap set from your local grocer should work. Just make sure you have both hex & flat-head bits.



---
{{<playcar
>}}