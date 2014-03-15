<?php
namespace Pharborist;

/**
 * List of arguments.
 * @package Pharborist
 */
class ArgumentListNode extends ListNode {
  /**
   * @var Node[]
   */
  public $arguments;

  /**
   * Constructor.
   */
  public function __construct() {
    $this->arguments = &$this->items;
  }
}
