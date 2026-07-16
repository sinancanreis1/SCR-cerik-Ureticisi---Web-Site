import { Link, usePage } from '@inertiajs/react';
import { useState, useEffect } from 'react';

export default function MainLayout({ children }) {
    const { categories, settings, footer_links, footer_column2_items, header_links } = usePage().props;
    const [scrolled, setScrolled] = useState(false);
    const [mobileMenuOpen, setMobileMenuOpen] = useState(false);
    const [scrollTopVisible, setScrollTopVisible] = useState(false);
    const [searchOpen, setSearchOpen] = useState(false);
    const [mobileServicesOpen, setMobileServicesOpen] = useState(false);
    const [openMobileCats, setOpenMobileCats] = useState({});

    const toggleMobileCat = (e, id) => {
        e.preventDefault();
        setOpenMobileCats(prev => ({ ...prev, [id]: !prev[id] }));
    };

    useEffect(() => {
        const handleScroll = () => {
            setScrolled(window.scrollY > 50);
            setScrollTopVisible(window.scrollY > 400);
        };
        window.addEventListener('scroll', handleScroll);
        return () => window.removeEventListener('scroll', handleScroll);
    }, []);

    // Close mobile menu on resize
    useEffect(() => {
        const handleResize = () => {
            if (window.innerWidth > 992) setMobileMenuOpen(false);
        };
        window.addEventListener('resize', handleResize);
        return () => window.removeEventListener('resize', handleResize);
    }, []);

    // Scroll reveal animation
    useEffect(() => {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

        document.querySelectorAll('.reveal, .reveal-left, .reveal-right').forEach(el => {
            observer.observe(el);
        });

        return () => observer.disconnect();
    }, []);



    const scrollToTop = () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    return (
        <div className="app-container">
            {/* ===== HEADER ===== */}
            <header className={`header ${scrolled ? 'scrolled' : ''}`}>
                <div className="container header-inner">
                    <Link href="/" className="logo">
                        <img src="/images/logo.png" alt="Samsun Şehir İşitme Cihazları Merkezi Logo" className="header-logo-img" />
                    </Link>
                    <nav className="nav">
                        {header_links && header_links.map(link => {
                            if (link.url === '/hizmetlerimiz') {
                                return (
                                    <div key={link.id} className="mega-menu-trigger">
                                        <Link href={link.url} className="nav-link">
                                            {link.icon && <i className={link.icon} style={{ marginRight: '6px' }}></i>}
                                            {link.label}
                                        </Link>
                                        <div className="mega-menu" style={{ width: '900px', gridTemplateColumns: 'repeat(4, 1fr)' }}>
                                            {categories && categories.length > 0 ? categories.map(parent => (
                                                <div key={parent.id} className="mega-menu-column" style={{ marginBottom: '25px' }}>
                                                    <h3 style={{ color: 'var(--color-primary)', borderBottom: '1px solid #eee', paddingBottom: '8px', marginBottom: '12px', fontSize: '15px' }}>
                                                        {parent.name}
                                                    </h3>
                                                    {parent.children && parent.children.length > 0 && (
                                                        <ul className="mega-menu-list">
                                                            {parent.children.map(child => (
                                                                <li key={child.id}>
                                                                    <Link href={`/hizmetler/${child.slug}`}>{child.name}</Link>
                                                                </li>
                                                            ))}
                                                        </ul>
                                                    )}
                                                </div>
                                            )) : (
                                                <div style={{ padding: '20px', color: '#666' }}>Henüz hizmet kategorisi eklenmedi.</div>
                                            )}
                                        </div>
                                    </div>
                                );
                            }

                            return (
                                <Link key={link.id} href={link.url} className="nav-link">
                                    {link.icon && <i className={link.icon} style={{ marginRight: '6px' }}></i>}
                                    {link.label}
                                </Link>
                            );
                        })}

                        <Link href="/iletisim" className="header-appointment-btn" style={{ marginLeft: '10px' }}>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/></svg>
                            İletişim & Randevu Al
                        </Link>

                        <button 
                            className="search-trigger-btn" 
                            onClick={() => setSearchOpen(true)}
                            aria-label="Arama Yap"
                            style={{ 
                                background: 'transparent', 
                                border: 'none', 
                                color: 'var(--color-white)', 
                                cursor: 'pointer', 
                                padding: '8px',
                                display: 'flex',
                                alignItems: 'center',
                                justifyContent: 'center',
                                transition: 'color 0.3s'
                            }}
                        >
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </button>
                    </nav>

                    {/* Mobile Header Controls */}
                    <div className="mobile-header-controls" style={{ display: 'flex', alignItems: 'center' }}>
                        <button 
                            className="mobile-search-btn" 
                            onClick={() => setSearchOpen(true)}
                            aria-label="Arama Yap"
                        >
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </button>

                        {/* Hamburger Button */}
                        <button
                            className={`hamburger-btn ${mobileMenuOpen ? 'active' : ''}`}
                            onClick={() => setMobileMenuOpen(!mobileMenuOpen)}
                            aria-label="Menü"
                        >
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </header>

            {/* ===== MOBILE MENU ===== */}
            <div className={`mobile-menu-overlay ${mobileMenuOpen ? 'active' : ''}`} onClick={() => setMobileMenuOpen(false)} />
            <div className={`mobile-menu ${mobileMenuOpen ? 'active' : ''}`}>
                <button className="mobile-menu-close" onClick={() => setMobileMenuOpen(false)}>✕</button>
                {header_links && header_links.map(link => {
                    if (link.url === '/hizmetlerimiz') {
                        return (
                            <div key={link.id} className="mobile-nav-group">
                                <div 
                                    className="mobile-nav-link" 
                                    style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', cursor: 'pointer', borderBottom: mobileServicesOpen ? 'none' : '1px solid rgba(255, 255, 255, 0.08)' }}
                                    onClick={() => setMobileServicesOpen(!mobileServicesOpen)}
                                >
                                    <span>
                                        {link.icon && <i className={link.icon} style={{ marginRight: '8px' }}></i>}
                                        {link.label}
                                    </span>
                                    <i className={`ri-arrow-${mobileServicesOpen ? 'up' : 'down'}-s-line`} style={{ fontSize: '20px' }}></i>
                                </div>
                                
                                {mobileServicesOpen && (
                                    <div style={{ paddingLeft: '10px', paddingBottom: '10px', borderBottom: '1px solid rgba(255, 255, 255, 0.08)', background: 'rgba(0,0,0,0.1)', borderRadius: '0 0 8px 8px' }}>
                                        {categories && categories.length > 0 ? categories.map(cat => {
                                            const hasChildren = cat.children && cat.children.length > 0;
                                            const isCatOpen = openMobileCats[cat.id];
                                            
                                            return (
                                                <div key={cat.id} style={{ borderBottom: '1px solid rgba(255, 255, 255, 0.04)' }}>
                                                    <div 
                                                        className="mobile-nav-sublink" 
                                                        style={{ display: 'flex', justifyContent: 'space-between', alignItems: 'center', paddingRight: '10px', cursor: 'pointer' }}
                                                        onClick={(e) => hasChildren ? toggleMobileCat(e, cat.id) : null}
                                                    >
                                                        <span style={{ flex: 1, padding: '4px 0', color: hasChildren ? 'white' : 'rgba(255,255,255,0.8)' }}>
                                                            {cat.name}
                                                        </span>
                                                        {hasChildren && (
                                                            <div style={{ padding: '4px 10px', background: 'rgba(255,255,255,0.05)', borderRadius: '4px' }}>
                                                                <i className={`ri-arrow-${isCatOpen ? 'up' : 'down'}-s-line`} style={{ fontSize: '18px', color: 'var(--color-accent)' }}></i>
                                                            </div>
                                                        )}
                                                    </div>
                                                    
                                                    {hasChildren && isCatOpen && (
                                                        <div style={{ paddingLeft: '15px', borderLeft: '1px solid var(--color-accent)', marginLeft: '15px', marginBottom: '10px' }}>
                                                            {cat.children.map(child => (
                                                                <Link key={child.id} href={`/hizmetler/${child.slug}`} className="mobile-nav-sublink" style={{ fontSize: '14px', padding: '8px 0', color: 'rgba(255,255,255,0.7)' }} onClick={() => setMobileMenuOpen(false)}>
                                                                    - {child.name}
                                                                </Link>
                                                            ))}
                                                        </div>
                                                    )}
                                                </div>
                                            );
                                        }) : (
                                            <div style={{ padding: '15px', color: '#ccc', fontSize: '14px' }}>Kategori bulunamadı.</div>
                                        )}
                                    </div>
                                )}
                            </div>
                        );
                    }

                    return (
                        <Link key={link.id} href={link.url} className="mobile-nav-link" onClick={() => setMobileMenuOpen(false)}>
                            {link.icon && <i className={link.icon} style={{ marginRight: '8px' }}></i>}
                            {link.label}
                        </Link>
                    );
                })}
                <Link href="/iletisim" className="mobile-nav-link" onClick={() => setMobileMenuOpen(false)}>İletişim & Randevu</Link>

                <div className="mobile-menu-contact">
                    <a href={`tel:${(settings?.phone || '').replace(/[\s()]/g, '')}`}>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        {settings?.phone || '0(546) 978 93 55'}
                    </a>
                    <a href={`mailto:${settings?.email || 'Sehirisitme55@outlook.com.tr'}`}>
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        {settings?.email || 'Sehirisitme55@outlook.com.tr'}
                    </a>
                </div>
            </div>

            {/* ===== SEARCH OVERLAY ===== */}
            <div className={`search-overlay ${searchOpen ? 'active' : ''}`} style={{
                position: 'fixed',
                top: 0,
                left: 0,
                width: '100%',
                height: '100%',
                background: 'rgba(10, 38, 71, 0.98)',
                zIndex: 2000,
                display: searchOpen ? 'flex' : 'none',
                alignItems: 'center',
                justifyContent: 'center',
                opacity: searchOpen ? 1 : 0,
                transition: 'opacity 0.3s ease'
            }}>
                <button 
                    onClick={() => setSearchOpen(false)}
                    style={{ position: 'absolute', top: '40px', right: '40px', background: 'transparent', border: 'none', color: 'white', cursor: 'pointer' }}
                >
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
                </button>
                <div style={{ width: '100%', maxWidth: '800px', padding: '0 20px' }}>
                    <form action="/arama" method="GET" style={{ position: 'relative' }}>
                        <input 
                            type="text" 
                            name="q" 
                            placeholder="Sitede arayın..." 
                            style={{ 
                                width: '100%', 
                                background: 'transparent', 
                                border: 'none', 
                                borderBottom: '2px solid rgba(255,255,255,0.3)', 
                                color: 'white', 
                                fontSize: '36px', 
                                padding: '15px 60px 15px 0', 
                                outline: 'none',
                                fontFamily: "'Playfair Display', serif"
                            }} 
                            autoFocus={searchOpen}
                        />
                        <button type="submit" style={{ position: 'absolute', right: '10px', top: '50%', transform: 'translateY(-50%)', background: 'transparent', border: 'none', color: 'white', cursor: 'pointer' }}>
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </button>
                    </form>
                    <p style={{ color: 'rgba(255,255,255,0.5)', marginTop: '20px', fontSize: '15px' }}>Örn: Şarjlı işitme cihazları, çınlama tedavisi, randevu...</p>
                </div>
            </div>

            {/* ===== MAIN CONTENT ===== */}
            <main>
                {children}
            </main>

            {/* ===== FOOTER - NEONAL STYLE ===== */}
            <footer className="footer">
                <div className="container">
                    <div className="footer-grid">
                        {/* Company Info */}
                        <div className="footer-col">
                            <Link href="/" className="logo" style={{ marginBottom: '20px', display: 'inline-block' }}>
                                <img src="/images/logo.png" alt="Samsun Şehir İşitme Cihazları Merkezi Logo" className="footer-logo-img" />
                            </Link>
                            <p className="footer-about-text">
                                {settings?.footer_about_text || 'Duyduğunuz her an değerli. 15 yılı aşkın tecrübemiz ve uzman kadromuzla, size en uygun işitme çözümlerini sunarak hayatınıza ses katıyoruz.'}
                            </p>
                            <div style={{ marginTop: '20px', marginBottom: '20px', color: 'rgba(255,255,255,0.8)', fontSize: '14px', lineHeight: '1.6', display: 'flex', alignItems: 'flex-start' }}>
                                <i className="ri-map-pin-fill" style={{ marginRight: '10px', color: 'var(--color-accent)', fontSize: '18px', marginTop: '2px' }}></i>
                                <span style={{ whiteSpace: 'pre-line' }}>{settings?.address || 'Samsun Şehir İşitme Cihazları Merkezi, Canik / Samsun'}</span>
                            </div>
                            <div className="footer-social">
                                {settings?.facebook_url && (
                                    <a href={settings.facebook_url} target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                    </a>
                                )}
                                {settings?.instagram_url && (
                                    <a href={settings.instagram_url} target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                    </a>
                                )}
                                {settings?.twitter_url && (
                                    <a href={settings.twitter_url} target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
                                    </a>
                                )}
                                {settings?.linkedin_url && (
                                    <a href={settings.linkedin_url} target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                    </a>
                                )}
                            </div>
                        </div>

                        {/* Quick Links */}
                        <div className="footer-col">
                            <h4>Hızlı Bağlantılar</h4>
                            <ul className="footer-links">
                                {footer_links && footer_links.filter(l => l.column === 'quick_links').map(link => (
                                    <li key={link.id}>
                                        <Link href={link.url}>
                                            {link.icon && <i className={link.icon} style={{ marginRight: '8px' }}></i>}
                                            {link.label}
                                        </Link>
                                    </li>
                                ))}
                                {(!footer_links || footer_links.filter(l => l.column === 'quick_links').length === 0) && (
                                    <>
                                        <li><Link href="/">Ana Sayfa</Link></li>
                                        <li><Link href="/hakkimizda">Hakkımızda</Link></li>
                                        <li><Link href="/urunler">Ürünler</Link></li>
                                        <li><Link href="/hizmetlerimiz">Hizmetlerimiz</Link></li>
                                        <li><Link href="/iletisim">İletişim & Randevu Al</Link></li>
                                    </>
                                )}
                            </ul>
                        </div>



                        {/* Services */}
                        <div className="footer-col">
                            <h4>{settings?.footer_column2_title || 'Hizmetlerimiz'}</h4>
                            <ul className="footer-links">
                                {settings?.footer_column2_type === 'custom' || (!settings?.footer_column2_type && footer_links && footer_links.filter(l => l.column === 'services').length > 0) ? (
                                    footer_links && footer_links.filter(l => l.column === 'services').map(link => (
                                        <li key={link.id}>
                                            <Link href={link.url}>
                                                {link.icon && <i className={link.icon} style={{ marginRight: '8px' }}></i>}
                                                {link.label}
                                            </Link>
                                        </li>
                                    ))
                                ) : settings?.footer_column2_type === 'products' ? (
                                    footer_column2_items?.map(product => (
                                        <li key={product.id}><Link href={`/urunler/${product.slug}`}>{product.title}</Link></li>
                                    ))
                                ) : settings?.footer_column2_type === 'blogs' ? (
                                    footer_column2_items?.map(blog => (
                                        <li key={blog.id}><Link href={`/blog/${blog.slug}`}>{blog.title}</Link></li>
                                    ))
                                ) : (
                                    categories && categories.slice(0, 8).map(category => (
                                        <li key={category.id}><Link href={`/hizmetler/${category.slug}`}>{category.name}</Link></li>
                                    ))
                                )}
                            </ul>
                        </div>

                        {/* Working Hours - Neonal Style */}
                        <div className="footer-col">
                            <h4>Çalışma Saatleri</h4>
                            <ul className="working-hours">
                                {settings?.working_hours ? (
                                    settings.working_hours.split('\n').map((line, idx) => {
                                        let day = line.trim();
                                        let time = '';
                                        
                                        const colonIndex = line.indexOf(':');
                                        const firstDigitIndex = line.search(/\d/);
                                        
                                        if (colonIndex !== -1 && (firstDigitIndex === -1 || colonIndex < firstDigitIndex)) {
                                            day = line.substring(0, colonIndex).trim();
                                            time = line.substring(colonIndex + 1).trim();
                                        } else if (firstDigitIndex !== -1) {
                                            day = line.substring(0, firstDigitIndex).trim();
                                            time = line.substring(firstDigitIndex).trim();
                                        } else {
                                            const words = line.trim().split(/\s+/);
                                            if (words.length > 1 && words[words.length - 1].toLowerCase().includes('kapalı')) {
                                                time = words.pop();
                                                day = words.join(' ');
                                            }
                                        }
                                        
                                        return (
                                            <li key={idx}>
                                                <span className="day">{day}</span>
                                                {time && <span className={time.toLowerCase().includes('kapalı') ? 'closed' : 'time'}>{time}</span>}
                                            </li>
                                        );
                                    })
                                ) : (
                                    <>
                                        <li><span className="day">Pazartesi - Cuma</span><span className="time">09:00 - 18:00</span></li>
                                        <li><span className="day">Cumartesi</span><span className="time">09:00 - 18:00</span></li>
                                        <li><span className="day">Pazar</span><span className="closed">Kapalı</span></li>
                                    </>
                                )}
                            </ul>
                        </div>
                    </div>
                    <div className="footer-bottom">
                        © 2026 Samsun Şehir İşitme Cihazları Merkezi. Tüm Hakları Saklıdır. | <a href="#">Gizlilik Politikası</a>
                    </div>
                </div>
            </footer>

            {/* ===== SCROLL TO TOP ===== */}
            <button className={`scroll-top ${scrollTopVisible ? 'visible' : ''}`} onClick={scrollToTop} aria-label="Yukarı">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2.5" strokeLinecap="round" strokeLinejoin="round">
                    <polyline points="18 15 12 9 6 15"/>
                </svg>
            </button>
        </div>
    );
}
