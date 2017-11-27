<?php
/**
 * Created by PhpStorm.
 * User: marci
 * Date: 26/11/2017
 * Time: 21:22
 */
include '../../vendor/autoload.php';
//Instalar o FFMPeg no servidor
$ffmpeg = FFMpeg\FFMpeg::create(array(
    'ffmpeg.binaries' => 'ffmpeg',
    'ffprobe.binaries' => 'ffprobe'
));
$video = $ffmpeg->open('teste.mp4');

$format = new FFMpeg\Format\Audio\Flac();
$format->on('progress', function ($audio, $format, $percentage) {
    echo "$percentage % transcoded";
});

$format
    ->setAudioChannels(2)
    ->setAudioKiloBitrate(256);

$video->save($format, 'track.flac');