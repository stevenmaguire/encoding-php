<?php namespace Stevenmaguire\EncodingDotCom;

use Stevenmaguire\EncodingDotCom\Contracts\Jsonable;

class SplitScreen implements Jsonable
{
    use Traits\GetTrait;
    use Traits\JsonifyTrait;

    /**
     * Number of columns
     *
     * @var integer
     */
    protected $columns;

    /**
     * Number of rows
     *
     * @var integer
     */
    protected $rows;

    /**
     * Number of pixels for left padding
     *
     * @var integer
     */
    protected $padding_left;

    /**
     * Number of pixels for right padding
     *
     * @var integer
     */
    protected $padding_right;

    /**
     * Number of pixels for bottom padding
     *
     * @var integer
     */
    protected $padding_bottom;

    /**
     * Number of pixels for top padding
     *
     * @var integer
     */
    protected $padding_top;

    /**
     * Default padding pixels
     *
     * @var integer
     */
    private $default_padding = 10;

    /**
     * Set columns
     *
     * @param integer $columns
     *
     * @return Stevenmaguire\EncodingDotCom\SplitScreen
     */
    public function setColumns($columns = 1)
    {
        $this->columns = $columns;
        return $this;
    }

    /**
     * Set rows
     *
     * @param integer $rows
     *
     * @return Stevenmaguire\EncodingDotCom\SplitScreen
     */
    public function setRows($rows = 1)
    {
        $this->rows = $rows;
        return $this;
    }

    /**
     * Set left padding
     *
     * @param integer $pixels
     *
     * @return Stevenmaguire\EncodingDotCom\SplitScreen
     */
    public function setPaddingLeft($pixels = null)
    {
        $this->setPadding('padding_left', $pixels);
        return $this;
    }

    /**
     * Set right padding
     *
     * @param integer $pixels
     *
     * @return Stevenmaguire\EncodingDotCom\SplitScreen
     */
    public function setPaddingRight($pixels = null)
    {
        $this->setPadding('padding_right', $pixels);
        return $this;
    }

    /**
     * Set top padding
     *
     * @param integer $pixels
     *
     * @return Stevenmaguire\EncodingDotCom\SplitScreen
     */
    public function setPaddingTop($pixels = null)
    {
        $this->setPadding('padding_top', $pixels);
        return $this;
    }

    /**
     * Set bottom padding
     *
     * @param integer $pixels
     *
     * @return Stevenmaguire\EncodingDotCom\SplitScreen
     */
    public function setPaddingBottom($pixels = null)
    {
        $this->setPadding('padding_bottom', $pixels);
        return $this;
    }

    /**
     * Set padding value
     *
     * @param string $property
     * @param integer $pixels
     */
    private function setPadding($property, $pixels)
    {
        if (is_null($pixels)) {
            $pixels = $this->default_padding;
        }
        $this->$property = $pixels;
    }
}
