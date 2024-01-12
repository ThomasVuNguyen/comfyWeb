import 'package:comfyweb/homepage/ComfyTitle.dart';
import 'package:comfyweb/homepage/HomeAppbar.dart';
import 'package:comfyweb/homepage/OneLinePitch.dart';
import 'package:flutter/material.dart';

class MyHomePage extends StatefulWidget {
  const MyHomePage({super.key});
  @override
  State<MyHomePage> createState() => _MyHomePageState();
}

class _MyHomePageState extends State<MyHomePage> {
  static const String route = '/';
  @override
  Widget build(BuildContext context) {

    return Scaffold(
      appBar: AppBar(
        title: ComfyTitle(),
      ),
      body: OneLinePitch(),
    );
  }
}
