<?php

use App\Models\Product;
use Illuminate\Support\Str;

Product::truncate();

$products = [
    [
        'title' => 'Reisoğlu Restoran',
        'slug' => Str::slug('Reisoglu Restoran'),
        'category' => 'Yazılım',
        'desc' => '35 yıllık hizmette olan Reisoğlu için mevcut sitelerini farklı bir aşamaya taşıdık. yenilikçi ve modern bir arayüz yaptık. Restoran alanında, düğün, toplantı, kına, nişan alanında hizmet veriyor.',
        'long_desc' => '<h3>35 Yıllık Deneyim</h3>
<h3>Reisoğlu\'nda Buluşalım</h3>
<p>Sakarya\'nın kalbinde, nehrin serin sularına ve tabiatın yemyeşil dokusuna komşu olan Reisoğlu, şehrin temposundan bir adım uzaklaşıp derin bir nefes alacağınız eşsiz bir kaçış noktasıdır. Kurulduğumuz günden bu yana, konuklarımıza sadece bir mekan değil; doğayla iç içe, prestijli ve sıcak bir yaşam alanı sunuyoruz.</p>
<p>Usta şeflerimizin vizyonuyla şekillenen mutfağımızda, en taze malzemeleri sanata dönüştürüyoruz. Geleneksel tatlardan seçkin lezzetlere uzanan menülerimizle damaklarınıza dokunmayı hedefliyoruz. Kusursuz hijyen standartlarımız ve misafirperverliğimizle, aileniz ve sevdiklerinizle geçireceğiniz her anı unutulmaz kılıyoruz.</p>
<p>Aynı zamanda kurumsal dünyada fark yaratmak isteyen markaların da en güçlü destekçisiyiz. Dev organizasyonlara ev sahipliği yapabilen toplam 2500 kişilik kapasitemiz ve 1350 kişi kapasiteli gösterişli kapalı alanımızla vizyonunuzu yansıtıyoruz. Ayrıca, stratejik görüşmeleriniz için tasarlanmış 50 kişilik VIP odamız ve esnek yapılı 300 ile 400 kişilik özel toplantı salonlarımızla; kongrelerden lansmanlara, şirket yemeklerinden seminerlere kadar tüm iş etkinliklerinizi profesyonel bir dokunuşla taçlandırıyoruz.</p>
<p><strong>Sakarya\'nın yeni trendi: REİSOĞLU\'NDA BULUŞALIM!</strong></p>',
        'project_link' => 'http://reisoglurestoran.com/',
        'project_date' => '2024'
    ],
    [
        'title' => 'SCR Bilişim',
        'slug' => Str::slug('SCR Bilisim'),
        'category' => 'Yazılım',
        'desc' => 'scr bilişim 2025 yılında kurulmuş, web site, web yazılım, özel yazılım, grafik tasarım, video editörlük, içerik üretimi ve seo optimizasyon hizmeti veriyor.',
        'long_desc' => '<h3>Dijitalde Fark Yaratan</h3>
<h3>Sakarya\'dan Tüm Türkiye\'ye</h3>
<p>Mayıs 2025\'te Sakarya\'da kurulan SCR Bilişim; işletmelerin dijital dünyada güçlü bir iz bırakması için çalışan, teknoloji odaklı bir freelance ajandır.</p>
<h4>Mayıs 2025 — Kuruluş</h4>
<p>SCR Bilişim, işletmelerin dijital dönüşümüne katkı sağlamak amacıyla Sakarya\'da kuruldu. Küçük ve orta ölçekli işletmelere büyük ajans kalitesinde, uygun maliyetli dijital hizmetler sunmak temel misyonumuzdur.</p>
<h4>Güncel Teknolojiler</h4>
<p>Sürekli gelişen dijital dünyadaki en son trendleri ve yazılım teknolojilerini yakından takip ediyoruz. Projelerimizde modern ve sürdürülebilir çözümler kullanarak markanızı bir adım öne taşıyoruz.</p>
<h4>Freelance & Uzaktan Çalışma</h4>
<p>Sakarya merkezli olarak tüm Türkiye\'ye uzaktan hizmet veriyoruz. Doğrudan iletişim, hızlı teslimat ve kişisel ilgi ile her projeye sahip çıkıyoruz.</p>
<h4>Misyonumuz</h4>
<p>Her işletmenin dijital dünyada görünür, ölçülebilir ve sürdürülebilir bir varlık oluşturmasına yardımcı olmak. Karmaşık teknolojiyi, işletmeniz için basit ve etkili çözümlere dönüştürüyoruz.</p>
<ul>
    <li>2025 Kuruluş Yılı</li>
    <li>Sakarya Merkez</li>
    <li>3+ Yıl Deneyim</li>
    <li>100% Uzaktan Çalışma</li>
</ul>
<h4>Sunduğumuz Hizmetler</h4>
<ul>
    <li>Web Yazılımı</li>
    <li>Web & Grafik Tasarım</li>
    <li>SEO Optimizasyonu</li>
    <li>Google Analytics & Search Console</li>
</ul>',
        'project_link' => null,
        'project_date' => '2025'
    ],
    [
        'title' => 'Adıvar Petrol',
        'slug' => Str::slug('Adivar Petrol'),
        'category' => 'Yazılım',
        'desc' => 'Adıvar petrol için enerji çözümlerine uygun seo odaklı bir we sitesi yaptık.',
        'long_desc' => '<p>Adıvar Petrol olarak, 2021 yılında Sakarya da 2. kuşak olarak akaryakıt sektöründe faaliyet göstermekteyiz.1. Kuşak 1986 yılında Bp markası olarak Sakarya ili Adapazarında ilçesinde sektörde yerini almıştır. Büyüyen şirketimiz sırasıyla Bp, Petrol Ofisi, Shell, Termopet, Bestoil, Energy, Moil gibi büyük markalarla iş birliği yapmıştır.</p>
<p>Akaryakıttan madeni yağa, Taşıt Tanıma Sistemleri\'nden AdBlue tedariğine kadar her alanda tek çözüm ortağınızız. Sanayiden tarıma, filolardan bireysel sürücülere kadar uzanan hizmet ağımızla, sektördeki tecrübemizi teknolojiyle birleştirerek değer katmaya devam ediyoruz.</p>',
        'project_link' => null,
        'project_date' => '2024'
    ],
    [
        'title' => 'Bitirme Projesi',
        'slug' => Str::slug('Bitirme Projesi'),
        'category' => 'Yazılım',
        'desc' => 'bitirme projem olarka stok/depo takip sistemi yaptık. bununla ilgili de hem ön yüz hemde arka yüzde next.js kullandık.',
        'long_desc' => '<p>bitirme projem olarka stok/depo takip sistemi yaptık. bununla ilgili de hem ön yüz hemde arka yüzde next.js kullandık.</p>',
        'project_link' => null,
        'project_date' => '2024'
    ],
    [
        'title' => 'Sakarya Dijital Davetiye',
        'slug' => Str::slug('Sakarya Dijital Davetiye'),
        'category' => 'Yazılım',
        'desc' => 'Eski nesil davetiye yapısını kaldırıp hem doğaya zarar vermekten uzaklaştırmayı hedefleyen hem de teknolojiyi dünyanın her alanında doğru bir şekilde kullanılmasını sağlamayı hedeflemektedir. 2 adet demo sürümü var dır.',
        'long_desc' => '<p>Eski nesil davetiye yapısını kaldırıp hem doğaya zarar vermekten uzaklaştırmayı hedefleyen hem de teknolojiyi dünyanın her alanında doğru bir şekilde kullanılmasını sağlamayı hedeflemektedir. 2 adet demo sürümü var dır.</p>',
        'project_link' => null,
        'project_date' => '2024'
    ],
    [
        'title' => 'Dijital Davetiye Yenilikçi',
        'slug' => Str::slug('Dijital Davetiye Yenilikci'),
        'category' => 'Tasarım',
        'desc' => 'Sakarya Dijital davetiyenin demo sürümlerinden biridir.',
        'long_desc' => '<p>Sakarya Dijital davetiyenin demo sürümlerinden biridir.</p>',
        'project_link' => null,
        'project_date' => '2024'
    ],
    [
        'title' => 'Dijital Davetiye Sade',
        'slug' => Str::slug('Dijital Davetiye Sade'),
        'category' => 'Tasarım',
        'desc' => 'Sakarya Dijital davetiyenin demo sürümlerinden biridir.',
        'long_desc' => '<p>Sakarya Dijital davetiyenin demo sürümlerinden biridir.</p>',
        'project_link' => null,
        'project_date' => '2024'
    ]
];

foreach ($products as $product) {
    Product::create($product);
}

echo "Seeded ".count($products)." products successfully.\n";
