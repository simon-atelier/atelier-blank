#!/bin/bash
# Check string length to avoid malicious code injection
echo "Please enter name of block (kebab-case)..."
read strval
len=`expr "$strval" : '.*'`

if [ $len -ge 30 ]; then echo "error" ; exit
else echo "Block name OK"
fi

# Get current path in theme
current_path="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

# Create new folder for ACF block
mkdir -p "$current_path/acf/blocks/$strval"
cd "$current_path/acf/blocks/$strval"

# Write out new block.php file if file doesn't already exist
if [ -f "$strval-block.php" ];
then
   exit 1
else
   echo "<?php
if ( ! defined( 'ABSPATH' ) ) exit; 
include( __DIR__ . '/../../styles.php');

\$id = '$strval-' . \$block['id'];
if( !empty(\$block['anchor']) ) {
    \$id = \$block['anchor'];
}

\$className = '$strval custom-block';
if( !empty(\$block['className']) ) {
    \$className .= ' ' . \$block['className'];
}
if( !empty(\$block['align']) ) {
    \$className .= ' align' . \$block['align'];
}

\$fields = get_field('fields');

?>

<section id=\"<?php echo esc_attr($id); ?>\" class=\"<?php echo esc_attr($className); ?>\"<?php if (!empty(\$style_string)) echo \" style='\" . \$style_string . \"'\"; ?>>
    <?= \$fields['field'] ?>
</section>
" > "$strval-block.php"
fi

# Write out new sass file if file doesn't already exist
if [ -f "$strval.scss" ];
then
   exit 1
else
   echo "@import \"../../../assets/styles/scss/settings\";
@import \"../../../assets/styles/scss/mixins\";

.$strval {
  
}
" > "$strval.scss"
fi



# Write out new block.json file if file doesn't already exist
if [ -f "block.json" ];
then
   exit 1
else
   echo "{
    \"name\": \"$strval\",
    \"title\": \"$strval\",
    \"description\": \"\",
    \"style\": \"file:./$strval.css\",
    \"category\": \"flexi-blocks\",
    \"icon\": \"welcome-widgets-menus\",
    \"keywords\": [\"$strval\"],
    \"acf\": {
        \"mode\": \"auto\",
        \"renderTemplate\": \"$strval-block.php\"
    },
    \"supports\": {
        \"spacing\": {
            \"margin\": true,
            \"padding\": true
        }
    }
}
" > "block.json"
fi



echo "Block created"