import 'package:comfyweb/DownloadPage.dart';
import 'package:flutter/material.dart';

class DownLoadBtn extends StatefulWidget {
  const DownLoadBtn({super.key});
  @override
  State<DownLoadBtn> createState() => _DownLoadBtnState();
}

class _DownLoadBtnState extends State<DownLoadBtn> {
  @override
  Widget build(BuildContext context) {
    return TextButton(
        onPressed: (){
          Navigator.push(
              context, 
              MaterialPageRoute(builder: (context) => DownloadPage())
          );
        }, 
        child: Text('Download'));
  }
}
