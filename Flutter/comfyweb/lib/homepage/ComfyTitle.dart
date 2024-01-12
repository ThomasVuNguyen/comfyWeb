import 'package:flutter/material.dart';

class ComfyTitle extends StatelessWidget {
  const ComfyTitle({super.key});

  @override
  Widget build(BuildContext context) {
    return Row(
      children: [
        Image.network('assets/comfylogo.png', width: 40,),
        SizedBox(width: 10,),
        Text('Comfy Space'),
      ],
    );
  }
}
