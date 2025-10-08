<?php
const OUT_EXTENSION =".txt";
const OUT_DIR ="D:\\phpstudy_pro\\WWW\\decode\\output";

function base64Files($files)
{
    $count = 0;

    foreach ($files as $file) {
        $info = pathinfo($file);

        $mimeType = mime_content_type($file);
        $img = file_get_contents($file);
        $imageData = base64_encode($img);

        $per = base64_encode('#aaa#');
        $data = base64_encode('#data#');
        $base64 = base64_encode('#base64#');
        $dataUri = $per .  "{$data}:$mimeType;{$base64},$imageData" . $per;
        // printf($info['filename']);
        $name = $info['filename'] . OUT_EXTENSION;
        $txt = createTxt($name, $dataUri);
        $count++;
    }

    return $count;
}

function createTxt($name, $data)
{
    $path = OUT_DIR . '/' . $name;
    // fwrite($myfile, $txt);
    // create_dir($path);
    return file_put_contents($path, $data);
}

base64Files(["D:\\phpstudy_pro\\WWW\\decode\\image\\xbz_main.jpg"]);