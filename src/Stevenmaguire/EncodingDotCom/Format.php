<?php namespace Stevenmaguire\EncodingDotCom;

use Stevenmaguire\EncodingDotCom\Format\AudioOverlay;
use Stevenmaguire\EncodingDotCom\Format\ClosedCaptions;
use Stevenmaguire\EncodingDotCom\Format\Meta;
use Stevenmaguire\EncodingDotCom\Format\TextOverlay;
use Stevenmaguire\EncodingDotCom\Format\VideoCodecParameters;
use Stevenmaguire\EncodingDotCom\Format\VideoOverlay;
use Stevenmaguire\EncodingDotCom\Format\Watermark;

/**
 * @property integer $noise_reduction // 0,6
 * @property array $output
 * @property string $time
 * @property string $width
 * @property string $height
 * @property string $destination
 * @property string $video_codec
 * @property string $audio_codec
 * @property string $target
 * @property string $maps
 * @property string $image_format
 * @property string $resize_method
 * @property string $sharpen_sigma
 * @property string $remove_metadata // yes,no
 * @property string $gravity // northwest|north|northeast|west|center|east|southwest|south|southeast
 * @property string $shave // 9x12
 * @property string $unsharp_radius
 * @property string $unsharp_sigma
 * @property string $unsharp_gain
 * @property string $unsharp_threshold
 * @property integer $quality
 * @property integer $dpi
 * @property integer $bitrate
 * @property integer $audio_bitrate
 * @property integer $audio_sample_rate
 * @property integer $audio_channels_number
 * @property integer $audio_volume
 * @property integer $audio_normalization // 0-100
 * @property integer $framerate
 * @property integer $framerate_upper_threshold
 * @property string $size
 * @property string $fade_in // FadeInStart:FadeInDuration
 * @property string $fade_out // FadeOutStart:FadeOutDuration
 * @property integer $crop_left
 * @property integer $crop_top
 * @property integer $crop_right
 * @property integer $crop_bottom
 * @property string $keep_aspect_ratio // yes/no,
 * @property string $set_aspect_ratio // ASPECT_RATIO|source
 * @property string $add_meta // yes/no
 * @property string $hint // yes/no
 * @property string $rc_init_occupancy // RC Occupancy
 * @property integer $minrate
 * @property integer $maxrate
 * @property integer $bufsize
 * @property array $keyframe
 * @property integer $start
 * @property integer $duration
 * @property integer $force_keyframes
 * @property integer $bframes // 2/0
 * @property string $gop // cgop|sgop
 * @property array $destination
 * @property array $overlay // VideoOverlay
 * @property array $text_overlay // TextOverlay
 * @property array $audio_overlay // AudioOverlay
 * @property string $profile // high/main/baseline
 * @property string $turbo // yes/no
 * @property string $rotate // def|0|90|270
 * @property string $set_rotate // def|0|90|270
 * @property string $audio_sync // 1..N
 * @property string $video_sync // old|passthrough|cfr|vfr|auto
 * @property string $force_interlaced // tff|bff|no
 * @property string $strip_chapters // yes|no
 * @property ClosedCaptions $closed_captions
 * @property Meta $metadata
 * @property VideoCodecParameters $video_codec_parameters
 * @property Watermark $logo
 * @property string $type // srt|scc|webvtt|dfxp
 * @property string $strip_formatting // yes, no
 * @property string $time_offset
 */
class Format extends Model
{
    /**
     * Add audio overlay configuration
     *
     * @param AudioOverlay $overlay
     *
     * @return Format
     */
    public function setAudioOverlay(AudioOverlay $overlay)
    {
        return $this->mergeArrayAttribute('audio_overlay', $overlay);
    }

    /**
     * Set closed captions configuration
     *
     * @param ClosedCaptions $meta
     *
     * @return Format
     */
    public function setClosedCaptions(ClosedCaptions $captions)
    {
        return $this->setAttribute('closed_captions', $captions);
    }

    /**
     * Add destination
     *
     * @param string $destination
     *
     * @return Format
     */
    public function setDestination($destination)
    {
        return $this->mergeArrayAttribute('destination', $destination);
    }

    /**
     * Add key frame
     *
     * @param string $keyframe
     *
     * @return Format
     */
    public function setKeyframe($keyframe)
    {
        return $this->mergeArrayAttribute('keyframe', $keyframe);
    }

    /**
     * Alias for set watermark configuration
     *
     * @param Watermark $watermark
     *
     * @return Format
     */
    public function setLogo(Watermark $watermark)
    {
        return $this->setWatermark($watermark);
    }

    /**
     * Set meta configuration
     *
     * @param Meta $meta
     *
     * @return Format
     */
    public function setMeta(Meta $meta)
    {
        return $this->setAttribute('metadata', $meta);
    }

    /**
     * Alias for set meta configuration
     *
     * @param Meta $meta
     *
     * @return Format
     */
    public function setMetaData(Meta $meta)
    {
        return $this->setMeta($meta);
    }

    /**
     * Add output configuration
     *
     * @param string $output
     *
     * @return Format
     */
    public function setOutput($output)
    {
        return $this->mergeArrayAttribute('output', $output);
    }

    /**
     * Add text overlay configuration
     *
     * @param TextOverlay $overlay
     *
     * @return Format
     */
    public function setTextOverlay(TextOverlay $overlay)
    {
        return $this->mergeArrayAttribute('text_overlay', $overlay);
    }

    /**
     * Set video codec paramters configuration
     *
     * @param VideoCodecParameters $parameters
     *
     * @return Format
     */
    public function setVideoCodecParameters(VideoCodecParameters $parameters)
    {
        return $this->setAttribute('video_codec_parameters', $parameters);
    }

    /**
     * Add video overlay configuration
     *
     * @param VideoOverlay $overlay
     *
     * @return Format
     */
    public function setVideoOverlay(VideoOverlay $overlay)
    {
        return $this->mergeArrayAttribute('overlay', $overlay);
    }

    /**
     * Set watermark configuration
     *
     * @param Watermark $watermark
     *
     * @return Format
     */
    public function setWatermark(Watermark $watermark)
    {
        return $this->setAttribute('logo', $watermark);
    }
}
