<?php
// List of common stop words to be ignored
$stop_words = [
    "a", "about", "above", "after", "again", "against", "all", "am", "an", "and", "any", "are", "aren't", "as", "at",
    "be", "because", "been", "before", "being", "below", "between", "both", "but", "by", 
    "can't", "cannot", "could", "couldn't", "did", "didn't", "do", "does", "doesn't", "doing", "don't", "down", "during", 
    "each", "few", "for", "from", "further", "had", "hadn't", "has", "hasn't", "have", "haven't", "having", "he", "he'd", 
    "he'll", "he's", "her", "here", "here's", "hers", "herself", "him", "himself", "his", "how", "how's", 
    "i", "i'd", "i'll", "i'm", "i've", "if", "in", "into", "is", "isn't", "it", "it's", "its", "itself", 
    "let's", "me", "more", "most", "mustn't", "my", "myself", 
    "no", "nor", "not", 
    "of", "off", "on", "once", "only", "or", "other", "ought", "our", "ours", "ourselves", "out", "over", "own", 
    "same", "shan't", "she", "she'd", "she'll", "she's", "should", "shouldn't", "so", "some", "such", 
    "than", "that", "that's", "the", "their", "theirs", "them", "themselves", "then", "there", "there's", "these", "they", "they'd", 
    "they'll", "they're", "they've", "this", "those", "through", "to", "too", "under", "until", "up", "very", 
    "was", "wasn't", "we", "we'd", "we'll", "we're", "we've", "were", "weren't", "what", "what's", "when", "when's", 
    "where", "where's", "which", "while", "who", "who's", "whom", "why", "why's", "with", "won't", "would", "wouldn't", 
    "you", "you'd", "you'll", "you're", "you've", "your", "yours", "yourself", "yourselves"
];

function calculateWordFrequency($text, $stop_words) {
    $text = strtolower($text);
    
    $text = preg_replace("/[^\w\s]/", " ", $text);

    $words = str_word_count($text, 1);

    $filtered_words = array_diff($words, $stop_words);

    $word_freq = array_count_values($filtered_words);

    return $word_freq;
}

function sortWordFrequency($word_freq, $order) {
    if ($order == 'asc') {
        asort($word_freq);
    } else {
        arsort($word_freq);
    }
    return $word_freq;
}

$text = $_POST['text'];
$sort_order = $_POST['sort'];
$limit = (int)$_POST['limit'];

if (empty($text)) {
    echo "Please provide text input.";
    exit;
}

$word_freq = calculateWordFrequency($text, $stop_words);

$sorted_word_freq = sortWordFrequency($word_freq, $sort_order);

$limited_word_freq = array_slice($sorted_word_freq, 0, $limit, true);

echo "<h1>Word Frequency Results</h1>";
echo "<table border='1'>
        <tr>
            <th>Word</th>
            <th>Frequency</th>
        </tr>";

foreach ($limited_word_freq as $word => $freq) {
    echo "<tr>
            <td>{$word}</td>
            <td>{$freq}</td>
          </tr>";
}

echo "</table>";
?>
