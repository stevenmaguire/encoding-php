<?php namespace Stevenmaguire\EncodingDotCom;

/**
 * @property integer $columns
 * @property integer $rows
 * @property integer $padding_bottom
 * @property integer $padding_left
 * @property integer $padding_right
 * @property integer $padding_top
 */
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
     * @return SplitScreen
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
     * @return SplitScreen
     */
    public function setRows($rows = 1)
    {
        return $this->setAttribute('rows', $rows);
    }

    /**
     * Set all padding
     *
     * @param integer $pixels
     *
     * @return SplitScreen
     */
    public function setPadding($pixels = null)
    {
        return $this->setPaddingLeft($pixels)
            ->setPaddingRight($pixels)
            ->setPaddingBottom($pixels)
            ->setPaddingTop($pixels);
    }

    /**
     * Set left padding
     *
     * @param integer $pixels
     *
     * @return SplitScreen
     */
    public function setPaddingLeft($pixels = null)
    {
        return $this->setPaddingAttribute('padding_left', $pixels);
    }

    /**
     * Set right padding
     *
     * @param integer $pixels
     *
     * @return SplitScreen
     */
    public function setPaddingRight($pixels = null)
    {
        return $this->setPaddingAttribute('padding_right', $pixels);
    }

    /**
     * Set top padding
     *
     * @param integer $pixels
     *
     * @return SplitScreen
     */
    public function setPaddingTop($pixels = null)
    {
        return $this->setPaddingAttribute('padding_top', $pixels);
    }

    /**
     * Set bottom padding
     *
     * @param integer $pixels
     *
     * @return SplitScreen
     */
    public function setPaddingBottom($pixels = null)
    {
        return $this->setPaddingAttribute('padding_bottom', $pixels);
    }

    /**
     * Set padding value
     *
     * @param string $property
     * @param integer $pixels
     *
     * @return  SplitScreen
     */
    private function setPaddingAttribute($property, $pixels)
    {
        if (is_null($pixels)) {
            $pixels = $this->default_padding;
        }
        return $this->setAttribute($property, $pixels);
    }
}
