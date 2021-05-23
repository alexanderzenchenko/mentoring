<?php

namespace Controllers;

use Services\FileReader\Exceptions\NoFileReaderExistsException;
use Services\FileReader\FileReaderFactory;
use Services\FileUploader\Exceptions\FileTypeException;
use Services\FileUploader\Exceptions\FileUploaderException;
use Services\FileUploader\FileUploader;
use Services\TextAnalyzer\TextAnalyzerFactory;
use Services\HtmlReader\HtmlReader;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;

class IndexContorller
{
    /**
     * @return mixed
     */
    public function indexAction(Request $request)
    {
        $text = $request->get('text');
        $text = strip_tags($text);
        $text = htmlspecialchars($text);

        return $this->analyzeText($text);
    }

    public function analyzeFileAction(Request $request)
    {
        $fileUploader = new FileUploader();

        try {

            $uploadedFile = $fileUploader->upload('userfile', $request);

            $fileReader = FileReaderFactory::createFileReader($uploadedFile);
            $text = $fileReader->readFile($uploadedFile);

            return $this->analyzeText($text);

        } catch (FileUploaderException $e) {
            return $e->getMessage();
        } catch (FileTypeException $e) {
            return $e->getMessage();
        } catch (FileException $e) {
            return $e->getMessage();
        } catch (NoFileReaderExistsException $e) {
            return $e->getMessage();
        }
    }

    public function analyzeUrlAction(Request $request)
    {
        $html = file_get_contents($request->get('url'));

        $urlReader = new HtmlReader();
        $text = $urlReader->read($html);

        return $this->analyzeText($text);
    }

    private function analyzeText(string $text)
    {
        $createdAt =  (new \DateTime('now'))->format('D, d M Y H:i:s');
        $analyzer = TextAnalyzerFactory::createTextAnalyzer($text);

        return require_once './Templates/statistic.php';
    }
}
