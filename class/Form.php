<?php
class Form
{
    private $fields = array();
    private $action;
    private $submit = "Submit Form";
    private $jumField = 0;

    public function __construct($action = "", $submit = "Submit")
    {
        $this->action = $action;
        $this->submit = $submit;
    }

    public function displayForm()
    {
        echo "<form action='" . $this->action . "' method='POST'>";
        echo '<table class="table" width="100%">';
        foreach ($this->fields as $field) {
            echo "<tr><td align='right' width='200px'>" . $field['label'] . "</td>";
            echo "<td>";
            $this->generateField($field);
            echo "</td></tr>";
        }
        echo "<tr><td colspan='2'>";
        echo "<button type='submit' class='btn btn-primary'>" . $this->submit . "</button>";
        echo "</td></tr>";
        echo "</table>";
        echo "</form>";
    }

    private function generateField($field) {
        switch ($field['type']) {
            case 'textarea':
                echo "<textarea name='" . $field['name'] . "' class='form-control' rows='4'></textarea>";
                break;
            case 'select':
                echo "<select name='" . $field['name'] . "' class='form-select'>";
                foreach ($field['options'] as $value => $label) {
                    echo "<option value='" . $value . "'>" . $label . "</option>";
                }
                echo "</select>";
                break;
            case 'radio':
                foreach ($field['options'] as $value => $label) {
                    echo "<div class='form-check form-check-inline'>";
                    echo "<input type='radio' name='" . $field['name'] . "' value='" . $value . "' class='form-check-input'> ";
                    echo "<label class='form-check-label'>" . $label . "</label>";
                    echo "</div>";
                }
                break;
            case 'checkbox':
                foreach ($field['options'] as $value => $label) {
                    echo "<div class='form-check form-check-inline'>";
                    echo "<input type='checkbox' name='" . $field['name'] . "[]' value='" . $value . "' class='form-check-input'> ";
                    echo "<label class='form-check-label'>" . $label . "</label>";
                    echo "</div>";
                }
                break;
            case 'password':
                echo "<input type='password' name='" . $field['name'] . "' class='form-control'>";
                break;
            default:
                echo "<input type='text' name='" . $field['name'] . "' class='form-control'>";
                break;
        }
    }

    public function addField($name, $label, $type = "text", $options = array())
    {
        $this->fields[$this->jumField]['name'] = $name;
        $this->fields[$this->jumField]['label'] = $label;
        $this->fields[$this->jumField]['type'] = $type;
        $this->fields[$this->jumField]['options'] = $options;
        $this->jumField++;
    }
}
?>