---
title: "Playcar"
description: "An RC Car that's easy to build & fun to play with."
altImg: "image of playcar causing havoc"
video: /build/playcar/video_title.mov
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
    
    - name: Butt Connectors (optional)
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

assembly:
    - name: Fire up your 3D Printer!
      description:
      steps:  
        - img: 
          description: First let's print the 3D parts. You can find the 3d files & instruction in the link below.
          link: 
            url: https://www.printables.com/model/929071-playcar-a-comfy-rc-car
            img: https://media.printables.com/media/prints/929071/images/7083808_0de82f27-33a1-46df-a15f-1c67a5d1877b_2fe5a47f-dc32-49c2-8af4-427d683d0b98/thumbs/inside/1600x1200/jpg/timeline-1_01_00_01_21.webp
            description: Download the STL files below & 3D print them.
          note: If you don't have access to a 3D printer, email me at thomas@comfyspace.tech and I will print for you for free!


    - name: Mechanical assembly
      description: Let's put together the electronics & 3d-printed parts.
      steps:
        - pdf: https://www.slideshare.net/slideshow/embed_code/key/32Zr9IlsBWJlXT?hostedIn=slideshare&page=upload
        - name: It's alive!
          img:
          description: Take a moment to admire what you just built! Whoever designed this must be a genius.
        - description: Did you know that the wheels are very traversal?. Well, now you do!
          
    - name: Create electrical connections
      description: To provide power & data/control for the whole system, we will connect parts together using jumper wires.
      steps:
        - description: Just follow the schematic below and you'll be fine! 
        - name: Make electrical connections
          description: 
          pdf: https://www.slideshare.net/slideshow/embed_code/key/9G7b8gZ3Oh4UbM?hostedIn=slideshare&page=upload
          note: You can use butt connectors if soldering is not your jam!
        - description: Finally, put on the lid!
          img: /build/playcar/final-assembly.png
    - name: Put some software in your robots!
      description: Now, your robot is just a slew of plastics & metal binded together as a stylish paperweight. Let's put some software to make it sentient.
      steps:

      steps:
        - name: Download the Comfy app - 
          description: The Comfy application allows you to control Playcar without buying expensive controller & coding for hours. <a href="https://comfyspace.tech/download">Download</a> & create an account if you have not done so!
      steps:
        - name: Flash an OS
          description: Follow the video instruction to prepare the Operating System (OS).
          video: /build/playcar/flash-os.mov

        - name: Turn on the beast (and scan for IP address)
          description: Next, follow the video to turn on the robot (for the first time), yay!
          video: /build/playcar/ip-check.mov
          note: If you have a Linux/Mac computer, open "Terminal" and run "dig +short comfy.local" instead

    - name: Remotely control Playcar (using ComfySpace application)
      description: This is the final step to bring your Frankenstein to life!
      steps:
        - name: Add some buttons!
          description: In a professional setting, an experienced roboticist uses proprietary controllers and sophisticated remote control hardware.
          img: /build/playcar/fancy-controller.png
          img_note: This kit costs $170, by the way.
          note: We ain't got no time or money for that. But we (mostly) have a smartphone!
        - description: That's why I created ComfySpace, an application to control robots remotely.
          video: /build/playcar/remote-control-intro.mp4
        - description: Using the application, we will use your phone as a remote controller
          video: /build/playcar/setup-comfyspace.mov
        - description: Go & play with your PlayCar!
          video: /build/playcar/play-with-playcar.mp4
extra:
  - name: Customization
    description: You can customize the 3D design here!
    img: /build/playcar/cad-work.png
    url: https://cad.onshape.com/documents/ce454679e894303a0ee32b59/w/9d54d89ffd016244679e1564/e/e174f969d6d1654d10106797?renderMode=0&uiState=6682317baef2f63452943a4b
credit:
  - type: Inspiration
    img: /build/playcar/original-rover.png
    creator: nahueltaibo
    part: Rover Tracks v2
    url: https://www.thingiverse.com/thing:3112734
final_words:
    note: Congrats on your Playcar! Enjoy it, show it to neighbors, and share online. Email me a picture or video at thomas@comfyspace.tech to brighten my day!

download:
  name: true
---
{{<build
>}}