import { chromium } from 'playwright';

const outputPath = process.argv[2] || 'screenshot.png';

(async () => {
    const browser = await chromium.launch({ headless: true });
    const page = await browser.newPage({ viewport: { width: 1400, height: 900 } });

    // Go to login page
    await page.goto('http://laraveldesign.test/admin/login', { waitUntil: 'networkidle', timeout: 30000 });
    await page.waitForTimeout(1000);

    // Login
    await page.locator('input[type="email"]').fill('mrshanebarron@gmail.com');
    await page.locator('input[type="password"]').fill('password');
    await page.locator('button:has-text("Sign in")').click();
    await page.waitForTimeout(2000);

    // Navigate to Pages
    await page.click('a:has-text("Pages")');
    await page.waitForTimeout(2000);

    // Click New Page button
    await page.click('a:has-text("New Page")');
    await page.waitForTimeout(2000);

    // Take screenshot of create form
    await page.screenshot({ path: outputPath, fullPage: true });
    await browser.close();
    console.log(`Screenshot saved to ${outputPath}`);
})();
