import { chromium } from 'playwright';

const outputPath = process.argv[2] || 'screenshot.png';

(async () => {
    const browser = await chromium.launch({ headless: true });
    const page = await browser.newPage({ viewport: { width: 1600, height: 1000 } });

    // Go to login page
    await page.goto('http://laraveldesign.test/admin/login', { waitUntil: 'networkidle', timeout: 30000 });
    await page.waitForTimeout(1000);

    // Login
    await page.locator('input[type="email"]').fill('mrshanebarron@gmail.com');
    await page.locator('input[type="password"]').fill('password');
    await page.locator('button:has-text("Sign in")').click();
    await page.waitForTimeout(2000);

    // Navigate directly to page builder
    await page.goto('http://laraveldesign.test/admin/page-builder?post_id=1', { waitUntil: 'networkidle' });
    await page.waitForTimeout(4000); // Wait for GrapesJS to load

    // Take screenshot showing full editor
    await page.screenshot({ path: outputPath, fullPage: false });

    console.log('Current URL:', page.url());
    await browser.close();
    console.log(`Screenshot saved to ${outputPath}`);
})();
