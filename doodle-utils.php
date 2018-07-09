<?php
class DoodleUtils {

    /**
     * Helper function - checks, if a given Option is chosen. It supports numeric ids (legacy) and option names
     * @param $column - number of current column, when rendering the result table
     * @param $choices - available choices (parsed) in this doodle
     * @param $userdata - available data (selections, etc) of a given user
     * @return bool - true, if the option is chosen
     */
    public static function optionIsChosen($column, $choices, $userdata){
      // Case 1: Numeric IDs
      if (in_array($column, $userdata['choices'],true)){
          return true;
      }
      // Case 2: Search by option name
      $optionId = DoodleUtils::optionId($column,$choices);
      if (in_array($optionId, $userdata['choices'],true)) {
          return true;

      }
      return false;
    }

    /**
     * Calculates the identifier of an option.
     * Only the name is taken into account
     * @param $column - $column - number of current column, when rendering the result table
     * @param $choices - number of current column, when rendering the result table
     * @return mixed - option name
     */
    public static function optionId($column, $choices){
        return $choices[$column];
    }

    /**
     * Convert a selection (list of checked boxes) into an option-based array
     * Used before serialisation.
     * @param $selected_indexes
     * @param $choices
     * @return array with options
     */
    public static function selectedOptionIds($selected_indexes, $choices){
        $return_value = array();
        foreach($selected_indexes as $index){
            $return_value []= DoodleUtils::optionId($index,$choices);
        }
        return $return_value;
    }
}


?>
