import 'package:comfyweb/homepage/Buttons.dart';
import 'package:comfyweb/homepage/LaunchURL.dart';
import 'package:comfyweb/styles/TextStyles.dart';
import 'package:flutter/material.dart';
import 'package:seo_renderer/renderers/text_renderer/text_renderer_style.dart';
import 'package:seo_renderer/renderers/text_renderer/text_renderer_vm.dart';

class OneLinePitch extends StatefulWidget {
  const OneLinePitch({super.key});

  @override
  State<OneLinePitch> createState() => _OneLinePitchState();
}

class _OneLinePitchState extends State<OneLinePitch> {
  @override
  Widget build(BuildContext context) {
    return Center(
      child: Column(
        children: [
          Row(
            mainAxisAlignment: MainAxisAlignment.center,
            children: [
              TextRenderer(
                  style: TextRendererStyle.header1,
                  child: Text(
                      'Your ',
                    style: h1Style,
                  )),
              TextRenderer(
                  style: TextRendererStyle.header1,
                  child: Text(
                      'better',
                    style: h1StyleUnderlined,
                  )),
              TextRenderer(
                  style: TextRendererStyle.header1,
                  child: Text(
                    ' ',
                    style: h1Style,
                  )),
              GestureDetector(
                onTap: () async{
                  await LaunchUrl('https://www.raspberrypi.com');
                },
                  child: Image.network('assets/rpilogo.png', width: 80,)),
              TextRenderer(
                  style: TextRendererStyle.header1,
                  child: Text(
                      ' interface',
                    style: h1Style,
                  )),
            ],
          ),
          TextRenderer(
            style: TextRendererStyle.header2,
              child: Text(
                  'made with ease',
                style: h1SupportText,
              )),
          DownLoadBtn()
        ],
      ),
    );
  }
}
