# Fuzzy Time

### Usage

```lang=php
use Mic2100\FuzzyTime\GeneratorAwareTrait;
use Mic2100\FuzzyTime\GeneratorFactory;
use Mic2100\FuzzyTime\Language\Dictionaries\English;
use Mic2100\FuzzyTime\Language\LanguageFactory;

require_once 'vendor/autoload.php';

date_default_timezone_set('Europe/London');

$factory = new GeneratorFactory();
$english = $factory->get();
$german = $factory->get(LanguageFactory::get('german'));

class SampleClass
{
    use GeneratorAwareTrait;
}

$traitClass = new SampleClass();

while (true) {
    echo $english->getFuzzyTime() . PHP_EOL;
    echo $german->getFuzzyTime() . PHP_EOL;
    echo $traitClass->getFuzzyTime((new DateTime('-25 MINS')), LanguageFactory::get(English::HANDLE)) . PHP_EOL;
    sleep(30);
}

/*----------------------------------------------
 * Example Output
 *
 * five to one //$english->getFuzzyTime()
 * fünf vor ein //$german->getFuzzyTime()
 * half to twelve //$traitClass->getFuzzyTime((new DateTime('-25 MINS')), LanguageFactory::get(English::HANDLE))
 *
 * or
 *
 * three o'clock //$english->getFuzzyTime()
 * drei uhr //$german->getFuzzyTime()
 * twenty five to three //$traitClass->getFuzzyTime((new DateTime('-25 MINS')), LanguageFactory::get(English::HANDLE))
 */
```
