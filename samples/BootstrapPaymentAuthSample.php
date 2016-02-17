<?php
require_once('../IyzipayBootstrap.php');

IyzipayBootstrap::init();
class BootstrapPaymentAuthSample
{
    public function run() {
        $this->should_create_payment_with_physical_and_virtual_item_for_listing_or_subscription();
        $this->should_create_payment_with_virtual_product_for_market_place();
    }

    public function should_create_payment_with_virtual_product_for_market_place() {
        # create client configuration class
        $options = new \Iyzipay\Options();
        $options->setApiKey("api key");
        $options->setSecretKey("secret key");
        $options->setBaseUrl("https://stg.iyzipay.com");

        # create request class
        $request = new \Iyzipay\Request\CreatePaymentRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId("123456789");
        $request->setPrice("1");
        $request->setPaidPrice("1.1");
        $request->setInstallment(1);
        $request->setBasketId("B67832");
        $request->setPaymentChannel(Iyzipay\Model\PaymentChannel::WEB);
        $request->setPaymentGroup(Iyzipay\Model\PaymentGroup::PRODUCT);
        $request->setPaymentCard($this->newPaymentCard());
        $request->setBuyer($this->newBuyer());
        $request->setShippingAddress($this->newShippingAddress());
        $request->setBillingAddress($this->newBillingAddress());
        $request->setBasketItems($this->newBasketItems());

        # make request
        $response = \Iyzipay\Model\PaymentAuth::create($request, $options);

        # print response
        print_r($response);
    }

    public function should_create_payment_with_physical_and_virtual_item_for_listing_or_subscription() {
        # create client configuration class
        $options = new \Iyzipay\Options();
        $options->setApiKey("api key");
        $options->setSecretKey("secret key");
        $options->setBaseUrl("https://stg.iyzipay.com");

        # create request class
        $request = new \Iyzipay\Request\CreatePaymentRequest();
        $request->setLocale(\Iyzipay\Model\Locale::TR);
        $request->setConversationId("123456789");
        $request->setPrice("1");
        $request->setPaidPrice("1.1");
        $request->setInstallment(1);
        $request->setBasketId("B67832");
        $request->setPaymentChannel(Iyzipay\Model\PaymentChannel::WEB);
        $request->setPaymentGroup(Iyzipay\Model\PaymentGroup::SUBSCRIPTION);

        $paymentCard = new Iyzipay\Model\PaymentCard();
        $paymentCard->setCardHolderName("John Doe");
        $paymentCard->setCardNumber("5528790000000008");
        $paymentCard->setRegisterCard(0);
        $paymentCard->setExpireMonth("11");
        $paymentCard->setExpireYear("2017");
        $paymentCard->setCvc("123");
        $request->setPaymentCard($paymentCard);

        $buyer = new Iyzipay\Model\Buyer();
        $buyer->setId("BY789");
        $buyer->setName("Sabri Onur");
        $buyer->setSurname("Tüzün");
        $buyer->setEmail("onur.tuzun@iyzico.com");
        $buyer->setGsmNumber("+905350000000");
        $buyer->setIdentityNumber("74300864791");
        $buyer->setRegistrationDate("2013-04-21 15:12:09");
        $buyer->setLastLoginDate("2015-10-05 12:43:35");
        $buyer->setRegistrationAddress("Nidakule Göztepe İş Merkezi Merdivenköy Mah. Bora Sok. No:1 Kat:19 Bağımsız 70");
        $buyer->setCity("Istanbul");
        $buyer->setCountry("Turkiye");
        $buyer->setZipCode("34732");
        $buyer->setIp("85.34.78.112");
        $request->setBuyer($buyer);

        $shippingAddress = new \Iyzipay\Model\Address();
        $shippingAddress->setContactName("Hakan Erdoğan");
        $shippingAddress->setCity("Istanbul");
        $shippingAddress->setCountry("Turkiye");
        $shippingAddress->setAddress("19 Mayıs Mah. İnönü Cad. No:45 Kozyatağı");
        $shippingAddress->setZipCode("34742");
        $request->setShippingAddress($shippingAddress);

        $billingAddress = new \Iyzipay\Model\Address();
        $billingAddress->setContactName("Hakan Erdoğan");
        $billingAddress->setCity("Istanbul");
        $billingAddress->setCountry("Turkiye");
        $billingAddress->setAddress("19 Mayıs Mah. İnönü Cad. No:45 Kozyatağı");
        $billingAddress->setZipCode("34742");
        $request->setbillingAddress($billingAddress);

        $basketItems[] = null;
        $firstBasketItem = new Iyzipay\Model\BasketItem();
        $firstBasketItem->setId("BI101");
        $firstBasketItem->setName("Dükkan aboneliği ve katalog");
        $firstBasketItem->setCategory1("Abonelik");
        $firstBasketItem->setCategory2("Dükkan");
        $firstBasketItem->setItemType(Iyzipay\Model\BasketItemType::PHYSICAL);
        $firstBasketItem->setPrice("0.3");

        $secondBasketItem = new Iyzipay\Model\BasketItem();
        $secondBasketItem->setId("BI102");
        $secondBasketItem->setName("Listeleme aboneliği");
        $secondBasketItem->setCategory1("Abonelik");
        $secondBasketItem->setCategory2("Listeleme");
        $secondBasketItem->setItemType(Iyzipay\Model\BasketItemType::VIRTUAL);
        $secondBasketItem->setPrice("0.5");

        $thirdBasketItem = new Iyzipay\Model\BasketItem();
        $thirdBasketItem->setId("BI103");
        $thirdBasketItem->setName("Servis aboneliği");
        $thirdBasketItem->setCategory1("Abonelik");
        $thirdBasketItem->setCategory2("Servis");
        $thirdBasketItem->setItemType(Iyzipay\Model\BasketItemType::VIRTUAL);
        $thirdBasketItem->setPrice("0.2");

        $basketItems[0] = $firstBasketItem;
        $basketItems[1] = $secondBasketItem;
        $basketItems[2] = $thirdBasketItem;

        $request->setBasketItems($basketItems);

        # make request
        $response = Iyzipay\Model\PaymentAuth::create($request, $options);

        # print response
        print_r($response);
    }

    private function newPaymentCard()
    {
        $paymentCard = new Iyzipay\Model\PaymentCard();
        $paymentCard->setCardHolderName("John Doe");
        $paymentCard->setCardNumber("5528790000000008");
        $paymentCard->setRegisterCard(0);
        $paymentCard->setExpireMonth("11");
        $paymentCard->setExpireYear("2017");
        $paymentCard->setCvc("123");
        return $paymentCard;
    }

    private function newBuyer()
    {
        $buyer = new Iyzipay\Model\Buyer();
        $buyer->setId("100");
        $buyer->setName("Hakan");
        $buyer->setSurname("Erdoğan");
        $buyer->setIdentityNumber("16045258606");
        $buyer->setEmail("email@email.com");
        $buyer->setGsmNumber("05553456789");
        $buyer->setRegistrationDate("2011-02-17 12:00:00");
        $buyer->setLastLoginDate("2015-04-20 12:00:00");
        $buyer->setRegistrationAddress("Maltepe");
        $buyer->setCity("Istanbul");
        $buyer->setCountry("Turkiye");
        $buyer->setZipCode("34840");
        $buyer->setIp("192.168.123.102");
        return $buyer;
    }

    private function newShippingAddress()
    {
        $address = new \Iyzipay\Model\Address();
        $address->setContactName("Hakan Erdoğan");
        $address->setCity("Istanbul");
        $address->setCountry("Turkiye");
        $address->setAddress("19 Mayıs Mah. İnönü Cad. No:45 Kozyatağı");
        $address->setZipCode("34742");
        return $address;
    }

    private function newBillingAddress()
    {
        $address = new \Iyzipay\Model\Address();
        $address->setContactName("Hakan Erdoğan");
        $address->setCity("Istanbul");
        $address->setCountry("Turkiye");
        $address->setAddress("19 Mayıs Mah. İnönü Cad. No:45 Kozyatağı");
        $address->setZipCode("34742");
        return $address;
    }

    private function newBasketItems()
    {
        $basketItems[] = null;
        $firstBasketItem = new Iyzipay\Model\BasketItem();
        $firstBasketItem->setId("BI101");
        $firstBasketItem->setName("ABC Marka Kolye");
        $firstBasketItem->setCategory1("Giyim");
        $firstBasketItem->setCategory2("Aksesuar");
        $firstBasketItem->setItemType(Iyzipay\Model\BasketItemType::PHYSICAL);
        $firstBasketItem->setPrice("0.3");
        $firstBasketItem->setSubMerchantKey("subMerchantKey");
        $firstBasketItem->setSubMerchantPrice("0.27");

        $secondBasketItem = new Iyzipay\Model\BasketItem();
        $secondBasketItem->setId("BI102");
        $secondBasketItem->setName("XYZ Oyun Kodu");
        $secondBasketItem->setCategory1("Oyun");
        $secondBasketItem->setCategory2("Online Oyun Kodlari");
        $secondBasketItem->setItemType(Iyzipay\Model\BasketItemType::VIRTUAL);
        $secondBasketItem->setPrice("0.5");
        $secondBasketItem->setSubMerchantKey("subMerchantKey");
        $secondBasketItem->setSubMerchantPrice("0.42");

        $thirdBasketItem = new Iyzipay\Model\BasketItem();
        $thirdBasketItem->setId("BI103");
        $thirdBasketItem->setName("EDC Marka Usb");
        $thirdBasketItem->setCategory1("Elektronik");
        $thirdBasketItem->setCategory2("Usb / Cable");
        $thirdBasketItem->setItemType(Iyzipay\Model\BasketItemType::PHYSICAL);
        $thirdBasketItem->setPrice("0.2");
        $thirdBasketItem->setSubMerchantKey("subMerchantKey");
        $thirdBasketItem->setSubMerchantPrice("0.18");

        $basketItems[0] = $firstBasketItem;
        $basketItems[1] = $secondBasketItem;
        $basketItems[2] = $thirdBasketItem;

        return $basketItems;
    }
}