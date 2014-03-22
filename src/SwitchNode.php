<?php
namespace Pharborist;

/**
 * switch control structure.
 * @package Pharborist
 */
class SwitchNode extends StatementNode {
  /**
   * @var Node
   */
  public $switchOn;

  /**
   * @var Node[]
   */
  public $caseList;
}
