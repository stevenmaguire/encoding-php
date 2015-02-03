<?php namespace Stevenmaguire\EncodingDotCom\Format;

use Stevenmaguire\EncodingDotCom\Model;

/**
 * @property integer $keyint_min
 * @property integer $level
 * @property integer $sc_threshold
 * @property integer $bf
 * @property integer $b_strategy // 0,1,2
 * @property string $flags2 // +bpyramid, +wpred, +mixed_refs, +dct8×8, -fastpskip/+fastpskip, +aud
 * @property integer $coder // 0,1
 * @property integer $refs
 * @property string $flags // -loop/+loop, -psnr/+psnr
 * @property string $deblockalpha
 * @property string $deblockbeta
 * @property integer $cqp
 * @property float $crf
 * @property integer $qmin
 * @property integer $qmax
 * @property integer $qdiff
 * @property integer $bt
 * @property float $i_qfactor
 * @property float $b_qfactor
 * @property integer $chromaoffset
 * @property integer $pass // 1,2,3
 * @property string $rc_eq
 * @property float $qcomp
 * @property float $complexityblur
 * @property float $qblur
 * @property string $partitions
 * @property integer $directpred
 * @property string $flags2
 * @property string $me_method
 * @property integer $me_range
 * @property integer $subq
 * @property integer $trellis // 0,1,2
 */
class VideoCodecParameters extends Model
{

}
