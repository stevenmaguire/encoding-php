<?php

use Stevenmaguire\EncodingDotCom\Format;
use Stevenmaguire\EncodingDotCom\Format\AudioOverlay;
use Stevenmaguire\EncodingDotCom\Format\ClosedCaptions;
use Stevenmaguire\EncodingDotCom\Format\Meta;
use Stevenmaguire\EncodingDotCom\Format\TextOverlay;
use Stevenmaguire\EncodingDotCom\Format\VideoCodecParameters;
use Stevenmaguire\EncodingDotCom\Format\VideoOverlay;
use Stevenmaguire\EncodingDotCom\Format\Watermark;


class FormatTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->format = new Format;
    }

    public function test_It_Can_Add_AudioOverlay_Configuration()
    {
        $overlay = new AudioOverlay;

        $this->format->setAudioOverlay($overlay);

        $this->assertTrue(in_array($overlay, $this->format->audio_overlay));
    }

    public function test_It_Can_Add_ClosedCaptions_Configuration()
    {
        $captions = new ClosedCaptions;

        $this->format->setClosedCaptions($captions);

        $this->assertEquals($captions, $this->format->closed_captions);
    }

    public function test_It_Can_Add_Destination()
    {
        $destination = uniqid();

        $this->format->setDestination($destination);

        $this->assertTrue(in_array($destination, $this->format->destination));
    }

    public function test_It_Can_Add_Keyframe()
    {
        $keyframe = uniqid();

        $this->format->setKeyframe($keyframe);

        $this->assertTrue(in_array($keyframe, $this->format->keyframe));
    }

    public function test_It_Can_Add_Meta_Configuration()
    {
        $meta = new Meta;

        $this->format->setMeta($meta);
        $this->format->setMetaData($meta); // alias

        $this->assertEquals($meta, $this->format->metadata);
    }

    public function test_It_Can_Add_Output_Configuration()
    {
        $output = uniqid();

        $this->format->setOutput($output);

        $this->assertTrue(in_array($output, $this->format->output));
    }

    public function test_It_Can_Add_TextOverlay_Configuration()
    {
        $overlay = new TextOverlay;

        $this->format->setTextOverlay($overlay);

        $this->assertTrue(in_array($overlay, $this->format->text_overlay));
    }

    public function test_It_Can_Add_VideoCodecParameters_Configuration()
    {
        $params = new VideoCodecParameters;

        $this->format->setVideoCodecParameters($params);

        $this->assertEquals($params, $this->format->video_codec_parameters);
    }

    public function test_It_Can_Add_VideoOverlay_Configuration()
    {
        $overlay = new VideoOverlay;

        $this->format->setVideoOverlay($overlay);

        $this->assertTrue(in_array($overlay, $this->format->overlay));
    }

    public function test_It_Can_Add_Watermark_Configuration()
    {
        $watermark = new Watermark;

        $this->format->setWatermark($watermark);
        $this->format->setLogo($watermark); // alias

        $this->assertEquals($watermark, $this->format->logo);
    }
}
