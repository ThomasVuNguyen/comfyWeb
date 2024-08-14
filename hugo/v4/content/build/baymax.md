---
title: "Rappit"
description: "Your adorable humanoid robot friend"
altImg: "baymax promotional picture"
img: https://facts.net/wp-content/uploads/2023/09/19-facts-about-baymax-big-hero-6-the-series-1694000286.jpg

components:
    - name: Raspberry Pi Zero 2W
      img: https://www.cnx-software.com/wp-content/uploads/2021/10/Raspberry-Pi-Zero-2-W-board.jpg
      description: Small but mighty. Packed with plenty computing power, this bad boy is the brain of the operation.
      quantity: 1
      price: 15$
    - name: Small 3S Lipo battery
      img: https://m.media-amazon.com/images/I/611nRW-CQmL._AC_SX679_.jpg
      description: Small but packs lots of juice.
      quantity: 1
      price: 13$
    - name: PCA9685 16 Channel PWM Servo Driver
      img: https://m.media-amazon.com/images/I/71mRaPlEtsL._AC_SX679_PIbundle-2,TopRight,0,0_SH20_.jpg
      description: You can control a bazzilion servo motors with this.
      quantity: 1 (please ignore the fact that there are 2 in the picture)
      price: 6$
    - name: Servo Motor
      img: https://m.media-amazon.com/images/I/51Rg7+Y53SL._AC_SX679_.jpg
      description: This will serve as motion-creation sources of the robot.
      quantity: currently 16
      price: 50$ 

tools:
    - name: 3D Printer (optional)
      img: https://www.cnet.com/a/img/resize/743440ccfdec25dda93319ad4f362ae162bfffd0/hub/2022/09/06/f166bd01-ea0b-499f-bdc9-7d156e8e5cce/img-2138.jpg?auto=webp&width=1200
      description: This is used to create the enclosure. The device still works without an enclosure, so if you don't have a 3d printer, don't sweat it.
    - name: Screw Driver Set
      img: https://i5.walmartimages.com/seo/Hyper-Tough-44-Piece-Precision-Multi-type-Screwdriver-Bits-Set-TS99913A_f23c0e46-f267-48d5-87fe-17ea92e2884f.72e98357c6fd8c95fd22e454cff128cc.jpeg?odnHeight=2000&odnWidth=2000&odnBg=FFFFFF
      description: Nothing fancy, you can borrow a friend for an afternoon.

assembly:
    - name: Why?
      description: Baymax is just so freakin' adorable. Lots of power inside a package the shape of a giant marshmallow.
      steps:
        - img: https://media4.giphy.com/media/CQw94V8AMa556/200w.gif?cid=6c09b952lsi4gm852k6eapee4rh43ab202m6o16ylq7scg4h&ep=v1_gifs_search&rid=200w.gif&ct=g
          note: We all need a Baymax in our lives
        - description: He can be awesome when need be!
          img: https://media4.giphy.com/media/trpfSCyUR539u/200.gif?cid=6c09b952p3wmwx4zrxph1l6kljlf6p9h0bq2verxs0brajl8&ep=v1_internal_gif_by_id&rid=200.gif&ct=g

    - name: Joints - a fundamental building block
      description: To make the build cute & make you feel bubbly inside, print the enclosure below!
      steps:
        - img: https://cdn.tutsplus.com/cdn-cgi/image/width=360/vector/uploads/2014/02/The-joints.jpg
          description: When we (humans) move, we do so using our joints.
          note: Humanoid robots move the same way
        - img: https://www.queerscifi.com/wp-content/uploads/2018/06/aHR0cDovL3d3dy5saXZlc2NpZW5jZS5jb20vaW1hZ2VzL2kvMDAwLzA5OS83NDUvb3JpZ2luYWwvYXRsYXMtcm9ib3QtcnVucy0wMi5naWY.gif
        - description: Currently, I'm working on desiging a joint for Baymax!
          link:
            url: https://cad.onshape.com/documents/c215176c74812b8969d56d07/w/8554165cde0d840e0f84a251/e/6818d56511f58bd522d8dede?renderMode=0&uiState=66bc1fdb7ac51e3304ed2e4a
            img: /build/baymax/joint.png
            description: Click to check it out!
            
    - name: What's next?
      description: Currently, I'm still working on Baymax. But if you want to get updates on its progress, sign up below!
      steps:
        - note: We promise to never use those email for dumb advertising!

tally:
    note: Sign up for updates
    code: npG7LE
---
{{<build>}}