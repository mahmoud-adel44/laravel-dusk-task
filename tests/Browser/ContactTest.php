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
                ->type('contact_name' , 'mahmoud Adel Ahmed')
                ->type('contact_email' , 'mahmoud.adel18@yahoo.com')
                ->type('contact_subject' , 'mahmoud Adel Ahmed - Back-end')
                ->type('contact_message' , 'test textarea')
                ->click('button[id="btn_submit_contact"]')
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
                ->type('contact_name' , '')
                ->type('contact_email' , '')
                ->type('contact_subject' , '')
                ->type('contact_message' , '')
                ->press('Send')
                ->waitForReload()
                ->scrollTo('div[class="contact-us"]')
                ->assertSee('The contact name field is required.')
                ->assertSee('The contact email field is required.')
                ->assertSee('The contact subject field is required.')
                ->assertSee('The contact message field is required.');
        });
    }
}
