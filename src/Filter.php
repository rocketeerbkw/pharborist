<?php
namespace Pharborist;

use Pharborist\Functions\FunctionCallNode;
use Pharborist\Functions\FunctionDeclarationNode;

/**
 * Factory for creating common callback filters.
 */
class Filter {
  /**
   * Callback returns true if any of the callbacks pass.
   *
   * @param callable[] $filters
   * @return callable
   */
  public static function any($filters) {
    return function ($node) use ($filters) {
      foreach ($filters as $filter) {
        if ($filter($node)) {
          return TRUE;
        }
      }
      return FALSE;
    };
  }

  /**
   * Callback returns true if all of the callbacks pass.
   *
   * @param callable[] $filters
   * @return callable
   */
  public static function all($filters) {
    return function ($node) use ($filters) {
      foreach ($filters as $filter) {
        if (!$filter($node)) {
          return FALSE;
        }
      }
      return TRUE;
    };
  }

  /**
   * Callback to filter for nodes of certain types.
   *
   * @param string $class_name ...
   *  At least one fully-qualified Pharborist node type to search for.
   *
   * @return callable
   */
  public static function isInstanceOf($class_name) {
    $classes = func_get_args();

    return function ($node) use ($classes) {
      foreach ($classes as $class) {
        if ($node instanceof $class) {
          return TRUE;
        }
      }
      return FALSE;
    };
  }

  /**
   * Callback to filter for specific function declaration.
   *
   * @param string $function_name ...
   *  At least one function name to search for.
   *
   * @return callable
   */
  public static function isFunction($function_name) {
    $function_names = func_get_args();

    return function ($node) use ($function_names) {
      if ($node instanceof FunctionDeclarationNode) {
        return in_array($node->getName()->getText(), $function_names, TRUE);
      }
      return FALSE;
    };
  }

  /**
   * Callback to filter for calls to a function.
   *
   * @param string $function_name ...
   *  At least one function name to search for.
   *
   * @return callable
   */
  public static function isFunctionCall($function_name) {
    $function_names = func_get_args();

    return function ($node) use ($function_names) {
      if ($node instanceof FunctionCallNode) {
        return in_array($node->getName()->getText(), $function_names, TRUE);
      }
      return FALSE;
    };
  }

  /**
   * Callback to filter for specific class declaration.
   *
   * @param string $class_name ...
   *  At least one class name to search for.
   *
   * @return callable
   */
  public static function isClass($class_name) {
    $class_names = func_get_args();

    return function ($node) use ($class_names) {
      if ($node instanceof ClassNode) {
        return in_array($node->getName()->getText(), $class_names, TRUE);
      }
      return FALSE;
    };
  }

  /**
   * Callback to filter for calls to a class method.
   * @param string $class_name
   * @param string $method_name
   * @return callable
   */
  public static function isClassMethodCall($class_name, $method_name) {
    return function ($node) use ($class_name, $method_name) {
      if ($node instanceof ClassMethodCallNode) {
        $class_matches = $node->getClassName()->getText() === $class_name;
        $method_matches = $node->getMethodName()->getText() === $method_name;
        return $class_matches && $method_matches;
      }
      return FALSE;
    };
  }

  /**
   * Callback to filter comments.
   * @param bool $include_doc_comment
   * @return callable
   */
  public static function isComment($include_doc_comment = TRUE) {
    if ($include_doc_comment) {
      return function ($node) {
        if ($node instanceof LineCommentBlockNode) {
          return TRUE;
        }
        elseif ($node instanceof CommentNode) {
          return !($node->parent() instanceof LineCommentBlockNode);
        }
        else {
          return FALSE;
        }
      };
    }
    else {
      return function ($node) {
        if ($node instanceof LineCommentBlockNode) {
          return TRUE;
        }
        elseif ($node instanceof DocCommentNode) {
          return FALSE;
        }
        elseif ($node instanceof CommentNode) {
          return !($node->parent() instanceof LineCommentBlockNode);
        }
        else {
          return FALSE;
        }
      };
    }
  }

  /**
   * Callback to test if match to given node.
   *
   * @param Node $match
   *
   * @return callable
   */
  public static function is(Node $match) {
    return function ($node) use ($match) {
      return $node === $match;
    };
  }
}
