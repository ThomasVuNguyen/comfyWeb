---
title: "Rappit"
description: "An AI friend you can talk to!"
altImg: "video demo of rappit, an ai chat device"
img: /build/rappit/intro.jpg

components:
    - name: Raspberry Pi Zero 2W
      img: https://www.cnx-software.com/wp-content/uploads/2021/10/Raspberry-Pi-Zero-2-W-board.jpg
      description: Small but mighty. Packed with plenty computing power, this bad boy is the brain of the operation.
      quantity: 1
      price: 15$
    - name: Rechargable AA batteries
      img: https://images.thdstatic.com/productImages/1a00d2b5-72bf-4832-9717-216161fef9bc/svn/blacks-energizer-rechargeable-battery-chargers-chvcmwb-4-4f_600.jpg
      description: Easy to use, sustainable & available everywhere.
      quantity: Pack of 4 + charger
      price: ~15$
    - name: Power bank (alternative to AA batteries)
      img: https://target.scene7.com/is/image/Target/GUEST_f106dfb3-1be1-4049-8522-1a5bcae7b472?wid=1200&hei=1200&qlt=80&fmt=webp
      description: Chances are you have one around the house. If not, pretty cheap.
      quantity: 1
      price: ~2$
    - name: Power supply (alternative to AA batteries)
      img: https://m.media-amazon.com/images/I/51O0vLttRfL._AC_UL640_FMwebp_QL65_.jpg
      description: You can even use your phone charger at home! Just make sure it's 5V.
      quantity: 1
      price: 2-10$ 

    - name: Screws
      img: https://www.harborfreight.com/media/catalog/product/cache/9fc4a8332f9638515cd199dd0f9238da/i/m/image_20117.jpg
      description: Wood screws (because they're cheap) to assemble parts together. A pack will last you years worth of projects. You can use some random screws around the house instead.
      quantity: 1
      price: 5$ 
    
    - name: MicroSD Card
      img: https://encrypted-tbn3.gstatic.com/shopping?q=tbn:ANd9GcTDNynOlYVkNSW3YegssxM0PbGjAmF5ItQFSm1W4u74el_OW_eTAh7qMb-4F2-Y0_RGVK4eNoGCRw1nnMCzaGki8oO3t3-pUJTTTdRU7l3jpNzLC7rfuiFJPUnqC9nHbQ&usqp=CAc
      description: This will be used to run the Operating System (OS). Anything above 8GB in capacity is enough.
      quantity: 1
      price: 4$ - 10$

tools:
    - name: 3D Printer (optional)
      img: https://www.cnet.com/a/img/resize/743440ccfdec25dda93319ad4f362ae162bfffd0/hub/2022/09/06/f166bd01-ea0b-499f-bdc9-7d156e8e5cce/img-2138.jpg?auto=webp&width=1200
      description: This is used to create the enclosure. The device still works without an enclosure, so if you don't have a 3d printer, don't sweat it.
    - name: Screw Driver Set
      img: https://i5.walmartimages.com/seo/Hyper-Tough-44-Piece-Precision-Multi-type-Screwdriver-Bits-Set-TS99913A_f23c0e46-f267-48d5-87fe-17ea92e2884f.72e98357c6fd8c95fd22e454cff128cc.jpeg?odnHeight=2000&odnWidth=2000&odnBg=FFFFFF
      description: Nothing fancy, you can borrow a friend for an afternoon.

assembly:
    - name: Why?
      description: Artificial Intelligence (AI) is everywhere, leading to the introduction of many devices such as the Rabbit R1 and Humane AI.
      steps:
        - img: /build/rappit/ai-device.png
          note: These devices cost 200-700$ (with subscriptions)
        - description: "I believe powerful devices like such should be accessible to all - cheap & simple to make/own."
        - description: That's why I created Rappit, an affordable DIY alternative that's easy to make.
          note: You can make your own for 20-40$!
    - name: Print some 3D stuff!
      description: To make the build cute & make you feel bubbly inside, print the enclosure below!
      steps:
        - img:
          link:
            url: https://www.printables.com/model/954310-rappit-a-diy-rabbit-r1-for-20/comments
            img: https://media.printables.com/media/prints/954310/images/7278678_cd1cc93b-ff12-41c9-b963-232498c30d5f_490d9145-92c0-4047-8a15-3560c823bb0d/thumbs/cover/320x240/jpg/img_2033.webp
            description: Download the STL files below & 3D print them per instruction.
    - name: Flash an OS onto the SD Card
      steps:
        - youtube: https://www.youtube.com/embed/4Qfb909ocQc
    - name: General Assembly
      description: This step involves making simple mechanical & electrical connections.
      steps:
        - description: Attach the AA batteries holder to the Enclosure.
          img: /build/rappit/assemble-1.png
          note: Remember to use rechargable AA instead of normal AA to avoid damaging the Raspberry Pi.
        - description: Assemble the Raspberry Pi (and SD cad)
          img: /build/rappit/assemble-2.png
        - description: Connect the AA battery holder to the Raspberry Pi 2W.
          img: /build/rappit/assemble-3.png
        - description: Put the Lid on top.
          img: /build/rappit/assemble-4.png
        - description: "Attach the ears (using #3 screws) and eyes & mouth (friction fit)"
          img: /build/rappit/assemble-5.png
        - description: Lastly, put on the Bottom Plate (friction fit)
          img: /build/rappit/assemble-6.png
    - name: Setup the software
      description: In this step, we will put some low-code software magic on this cutesy rabbit!
      steps:
        - youtube: https://youtube.com/embed/cB1Fydgjipk
          note: This works on both Playstore (Android) and Appstore (iOS)
    - name: Enjoy your newly created companion!
      description: Feel free to ask it anything!
      steps:
        - youtube: https://youtube.com/embed/1yaQxBpiEMA
final_words:
    note: Congrats on your Rappit! Enjoy it & share onlin!. Email me a picture or video at thomas@comfyspace.tech to brighten my day!
extra:
  - name: Customization
    description: You can customize the 3D design here!
    img: /build/rappit/cad.png
    url: https://cad.onshape.com/documents/fc179e880583a401c85eac67/w/19d42bbe61a08bec1eeaf4cf/e/2dfb50edc0b5ff8f11a13583
---
{{<build>}}