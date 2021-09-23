<?php

namespace App\Tests\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @author Kseniia Komarchuk <kseniia.komarchuk@gmail.com>
 * Class DefaultControllerTest
 * @package App\Tests\Controller
 *
 */
class DefaultControllerTest extends WebTestCase
{

    /**
     * general test actions for the Homepage
     */
    public function testActions(): void
    {
        $client =static::createClient();
        $crawler = $client->request('GET', '/');
        $this->assertResponseIsSuccessful();

        $postLink = $crawler -> selectLink ('Створити');
        $this->assertCount(1, $postLink);

        $postLink = $crawler -> selectLink ('Рейтинг');
        $this->assertCount(1, $postLink);

        $postLink = $crawler -> selectLink ('Підписатись');
        $this->assertCount(1, $postLink);

        $this->assertSelectorTextContains('h1', 'Технічний Комітет з Фристайлу');
        $this->assertSelectorTextContains('h4', 'Про нас');

    }

    /**
     * test calling article process
     */
    public function testShowArticle(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/article/show/22');
        $this->assertResponseIsSuccessful();

        $postLink = $crawler -> selectLink ('Редагувати публікацію');
        $this->assertCount(1, $postLink);

        $postLink = $crawler -> selectLink ('Завантажити публікацію');
        $this->assertCount(2, $postLink);

    }

    /**
     * получение текущего айди поста, чтобы использовать для динамического тестирования
     * создания/ удаления/ редактирования
     * @return mixed
     */
    protected function getLastId()
    {
        $postRepository = static::getContainer()->get(PostRepository::class);
        $article = $postRepository->findOneBy([], ['id' => 'desc']);

        return $article->getId();
    }

    protected function getDescription()
    {
        $postRepository = static::getContainer()->get(PostRepository::class);
        $article = $postRepository->findOneBy([], ['id' => 'desc']);

        return $article->getDescription();
    }

    /**
     * test creation article process
     */
    public function testCreateArticle()
   {
        $client = static::createClient();
        $exLastId = $this->getLastId();

        $crawler = $client->request('GET', '/article/create');
        $this->assertResponseIsSuccessful();

        $form = $crawler->selectButton('Submit')->form();
        $form['article_form[name]'] = 'test name article';
        $form['article_form[description]'] = 'this is test description ';
        $form['article_form[body]'] = 'this is test body field';
        $client->submit($form);

        $currentLastId = $this->getLastId();
        $this->assertTrue($currentLastId > $exLastId);
        $this->assertResponseRedirects('/article/show/' . $currentLastId);

   }

    /**
     * test edit article process
     */
    public function testEditArticle()
   {
       $client = static ::createClient();
       $newId = $this->getLastId();
       $description = $this->getDescription();

       $crawler = $client->request('GET', '/article/edit/' . $newId);
       $this->assertResponseIsSuccessful();

       $form = $crawler->selectButton('Submit')->form();
       $form['article_form[name]'] = 'edit test name article';
       $form['article_form[description]'] = $description . ' edit this is test description';
       $form['article_form[body]'] = 'edit this is test body field';
       $client->submit($form);

       $this->assertResponseRedirects('/article/show/' . $newId);

   }

    /**
     * test delete article process
     */
    public function testArticleDelete(): void
    {
        $client = static::createClient();
        $value = $this->getLastId();
        $client->request('GET', '/delete/' . $value);

        $this->assertResponseRedirects('/');
    }
}
