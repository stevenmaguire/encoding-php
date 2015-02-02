<?php namespace Stevenmaguire\EncodingDotCom;

class SplitScreen extends Model
{
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
        return $this->setAttribute('columns', $columns);
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
        return $this->setAttribute('rows', $rows);
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
        return $this->setPadding('padding_left', $pixels);
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
        return $this->setPadding('padding_right', $pixels);
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
        return $this->setPadding('padding_top', $pixels);
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
        return $this->setPadding('padding_bottom', $pixels);
    }

    /**
     * Set padding value
     *
     * @param string $property
     * @param integer $pixels
     *
     * @return  SplitScreen
     */
    private function setPadding($property, $pixels)
    {
        if (is_null($pixels)) {
            $pixels = $this->default_padding;
        }
        return $this->setAttribute($property, $pixels);
    }
}
