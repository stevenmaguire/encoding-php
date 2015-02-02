<?php namespace Stevenmaguire\EncodingDotCom;

/**
 * @property string $noise_reduction // luma_spatial:chroma_spatial:luma_temp
 * @property array $output
 * @property string $video_codec
 * @property string $audio_codec
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
 * @property Meta $metadata
 * @property array $destination
 * @property Logo $logo
 * @property array $overlay // Overlay
 * @property array $text_overlay // TextOverlay
 * @property string $video_codec_parameters // "To see the example for parameters please follow this link below *",
 * @property string $profile // high/main/baseline
 * @property string $turbo // yes/no
 * @property string $rotate // def|0|90|270
 * @property string $set_rotate // def|0|90|270
 * @property string $audio_sync // 1..N
 * @property string $video_sync // old|passthrough|cfr|vfr|auto
 * @property string $force_interlaced // tff|bff|no
 * @property string $strip_chapters // yes|no
 */
class Format extends Model
{

}
