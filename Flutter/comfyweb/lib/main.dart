import 'package:flutter/material.dart';
import 'package:seo_renderer/helpers/robot_detector_vm.dart';

import 'homepage/MyHomePage.dart';

void main() {
  runApp(const MyApp());
}

class MyApp extends StatelessWidget {
  const MyApp({super.key});

  // This widget is the root of your application.
  @override
  Widget build(BuildContext context) {
    return RobotDetector(
      child: MaterialApp(
        title: 'Comfy Space',
        theme: ThemeData(
          colorScheme: ColorScheme.fromSeed(seedColor: Colors.deepPurple),
          useMaterial3: true,
        ),
        home: const MyHomePage(),
      ),
    );
  }
}

