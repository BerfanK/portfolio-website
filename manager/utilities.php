<?php 

// https://stackoverflow.com/questions/3161816/truncate-a-string-to-first-n-characters-of-a-string-and-add-three-dots-if-any-ch
function truncate($string, $length, $dots = "...") {
    return (strlen($string) > $length) ? substr($string, 0, ($length + 3) - strlen($dots)) . $dots : $string;
}

function getTagString($string) {

    $tagHtml = "";

    switch ($string) {

        case "C#":
            $tagHtml = '<span class="tag-cs">C#</span>';
            break;
        case "Desktop-Applikation":
            $tagHtml = '<span class="tag-cs">Desktop-Applikation</span>';
            break;
        case "ASP.NET":
            $tagHtml = '<span class="tag-cs">ASP.NET</span>';
            break;
        case "PHP":
            $tagHtml = '<span class="tag-php">PHP</span>';
            break;
        case "HTML":
            $tagHtml = '<span class="tag-html">HTML</span>';
            break;
        case "Bootstrap":
            $tagHtml = '<span class="tag-html">Bootstrap</span>';
            break;
        case "CSS":
            $tagHtml = '<span class="tag-html">CSS</span>';
            break;
        case "Tailwind":
            $tagHtml = '<span class="tag-html">Tailwind</span>';
            break;
        case "JavaScript":
            $tagHtml = '<span class="tag-js">JavaScript</span>';
            break;
        case "React.js":
            $tagHtml = '<span class="tag-js">React.js</span>';
            break;
        case "Next.js":
            $tagHtml = '<span class="tag-js">Next.js</span>';
            break;
        case "Java":
            $tagHtml = '<span class="tag-java">Java</span>';
            break;
    }

    return $tagHtml;
}

?>