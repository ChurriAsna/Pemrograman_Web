<?php

    class Product
    {
        //Atribut atau Properti
        protected static $name;
        protected static $price;
        protected static $discount;

        //Methode atau Fungsi
        function __construct()
        {
        }
        function getName()
        {
            echo "<br /> Nama produk : " . self::$name;
            return self::$name;
        }
        function setName($nm)
        {
            self::$name=$nm;
        }
        function getPrice()
        {
            echo " <br /> Harga produk : " . self::$price;
            return self::$price;
        }
        function setPrice($pr)
        {
            self::$price=$pr;
        }
        function getDiscount()
        {
            echo " <br /> Diskon produk : " . self::$discount;
            return self::$discount;
        }
        function setDiscount($dc)
        {
            self::$discount=$dc;
        }
    }

    class CDMusic extends Product
    {
        //Atribut atau Properti
        protected static $artist;
        protected static $genre;

        //Methode atau Fungsi
        function __construct()
        {
        }
        function getArtist()
        {
            echo " <br />";
            echo " <br /> Artis CD Musik : " . self::$artist;
            return self::$artist;
        }
        function setArtist($ar)
        {
            self::$artist=$ar;
        }
        function getGenre()
        {
            echo " <br /> Genre CD Musik : " . self::$genre;
            return self::$genre;
        }
        function setGenre($gr)
        {
            self::$genre = $gr;
        } 
        function getHargaCDMusic() 
        {
            $harga = parent::$price + (0.1 * parent::$price);
            echo " <br / >  Harga CD Musik : " . $harga;
        }
        function getDiskonCDMusic() 
        {
            $diskon = parent::$discount + (0.05 * parent::$discount);
            echo " <br / >  Diskon CD Musik : " . $diskon;
        }
    }

    class CDCabinet extends Product
    {
        //Atribut atau Properti
        protected static $capacity;
        protected static $model;

        //Methode atau Fungsi
        function __construct()
        {
        }
        function getCapacity()
        {
            echo "  <br /> ";
            echo "  <br /> Kapasitas : " . self::$capacity;
            return self::$capacity;
        }
        function setCapacity($cp)
        {
            self::$capacity=$cp;
        }
        function getModel()
        {
            echo " <br /> Model : " . self::$model;
        }
        function setModel($md)
        {
            self::$model=$md;
        } 
        function getHargaCDCabinet() 
        {
            $harga = parent::$price + (0.15 * parent::$price);
            echo " <br / >  Harga CD Cabinet : " . $harga;
        }
        function getDiskonCDCabinet() 
        {
            $diskon = parent::$discount + (0 * parent::$discount);
            echo " <br / >  Diskon CD Cabinet : " . $diskon;
        }
    };

    //Object Product
    $isi = new Product();
    $isi -> setName("Red");
    $isi -> setPrice("100000");
    $isi -> setDiscount("20000");
    $isi -> getName();
    $isi -> getPrice();
    $isi -> getDiscount();

    //Object CD Music
    $isi = new CDMusic();
    $isi -> setArtist("Taylor Swift");
    $isi -> setGenre("Pop");
    $isi -> getArtist();
    $isi -> getGenre();
    $isi -> getHargaCDMusic();
    $isi -> getDiskonCDMusic();
    
    //Object CD Cabinet
    $isi = new CDCabinet();
    $isi-> setCapacity("21");
    $isi-> setModel("371");
    $isi-> getCapacity();
    $isi-> getModel();
    $isi -> getHargaCDCabinet();
    $isi -> getDiskonCDCabinet();
?>