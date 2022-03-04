<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ContactTest extends DuskTestCase
{
    public function testSeeTheContactNowLink(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://proxyhulk.com/')
                ->assertSee('Contact now');
        });
    }

    public function testSendingContactMessage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://proxyhulk.com/')
                ->clickLink('Contact now')
                ->type('contact_name', 'mahmoud Adel Ahmed')
                ->type('contact_email', 'mhmoud.adel18@yahoo.com')
                ->type('contact_subject', 'mahmoud Adel Ahmed - Back-end')
                ->type('contact_message', 'https://github.com/mahmoud-adel44/laravel-dusk-task.git')
                ->press('Send')
                ->waitForReload()
                ->scrollTo('div[class="contact-us"]')
                ->assertDontSee('The contact name field is required.')
                ->assertDontSee('The contact email field is required.')
                ->assertDontSee('The contact subject field is required.')
                ->assertDontSee('The contact message field is required.');
        });
    }

    public function testSeeingValidationErrorMessages(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://proxyhulk.com/')
                ->clickLink('Contact now')
                ->type('contact_name', '')
                ->type('contact_email', '')
                ->type('contact_subject', '')
                ->type('contact_message', '')
                ->press('Send')
                ->waitForReload()
                ->scrollTo('div[class="contact-us"]')
                ->assertSee('The contact name field is required.')
                ->assertSee('The contact email field is required.')
                ->assertSee('The contact subject field is required.')
                ->assertSee('The contact message field is required.');
        });
    }


    public function testEmailFieldMustBeTypeEmailByEnterText(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://proxyhulk.com/')
                ->clickLink('Contact now')
                ->type('contact_name', 'test')
                ->type('contact_email', 'test')
                ->type('contact_subject', 'test')
                ->type('contact_message', 'test')
                ->press('Send')
                ->waitForReload()
                ->scrollTo('div[class="contact-us"]')
                ->assertSee('The contact email must be a valid email address.');
        });
    }

    public function testEmailFieldMustBeTypeEmailByEnterNumber(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://proxyhulk.com/')
                ->clickLink('Contact now')
                ->type('contact_name', 'test')
                ->type('contact_email', 123456)
                ->type('contact_subject', 'test')
                ->type('contact_message', 'test')
                ->press('Send')
                ->waitForReload()
                ->scrollTo('div[class="contact-us"]')
                ->assertSee('The contact email must be a valid email address.');
        });
    }

    public function testAllFieldsAreRequiredByLetEmailEmpty(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://proxyhulk.com/')
                ->clickLink('Contact now')
                ->type('contact_name', 'test')
                ->type('contact_email', '')
                ->type('contact_subject', 'test')
                ->type('contact_message', 'test')
                ->press('Send')
                ->waitForReload()
                ->scrollTo('div[class="contact-us"]')
                ->assertSee('The contact email field is required.');

        });
    }

    public function testAllFieldsAreRequiredByLetContactNameEmpty(): void
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('https://proxyhulk.com/')
                ->clickLink('Contact now')
                ->type('contact_name', '')
                ->type('contact_email', 'test@test.com')
                ->type('contact_subject', 'test')
                ->type('contact_message', 'test')
                ->press('Send')
                ->waitForReload()
                ->scrollTo('div[class="contact-us"]')
                ->assertSee('The contact name field is required.');

        });
    }


    public function testAllFieldsAreRequiredByLetSubjectAndMessageEmpty(): void
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('https://proxyhulk.com/')
                ->clickLink('Contact now')
                ->type('contact_name', 'test')
                ->type('contact_email', 'test@test.com')
                ->type('contact_subject', '')
                ->type('contact_message', '')
                ->press('Send')
                ->waitForReload()
                ->scrollTo('div[class="contact-us"]')
                ->assertSee('The contact subject field is required.')
                ->assertSee('The contact message field is required.');
        });
    }

    public function testAllFieldsAreRequiredByLetMessageEmpty(): void
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('https://proxyhulk.com/')
                ->clickLink('Contact now')
                ->type('contact_name', 'test')
                ->type('contact_email', 'test@test.com')
                ->type('contact_subject', 'test subject')
                ->type('contact_message', '')
                ->press('Send')
                ->waitForReload()
                ->scrollTo('div[class="contact-us"]')
                ->assertSee('The contact message field is required.');
        });
    }

    public function testAllFieldsAreRequiredByLetSubjectEmpty(): void
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('https://proxyhulk.com/')
                ->clickLink('Contact now')
                ->type('contact_name', 'test')
                ->type('contact_email', 'test@test.com')
                ->type('contact_subject', '')
                ->type('contact_message', 'test message')
                ->press('Send')
                ->waitForReload()
                ->scrollTo('div[class="contact-us"]')
                ->assertSee('The contact subject field is required.');
        });
    }
}
