import { chromium } from 'playwright';

const outputPath = process.argv[2] || 'screenshot.png';

(async () => {
    const browser = await chromium.launch({ headless: true });
    const page = await browser.newPage({ viewport: { width: 1400, height: 900 } });

    // Go to login page
    await page.goto('http://laraveldesign.test/admin/login', { waitUntil: 'networkidle', timeout: 30000 });

    // Wait for Livewire to initialize and form to be ready
    await page.waitForTimeout(1000);

    // Find and fill email field (Filament uses data.email)
    await page.locator('input[type="email"]').fill('mrshanebarron@gmail.com');

    // Find and fill password field
    await page.locator('input[type="password"]').fill('password');

    // Click sign in button
    await page.locator('button:has-text("Sign in")').click();

    // Wait for navigation/response
    await page.waitForTimeout(3000);

    // Take screenshot
    await page.screenshot({ path: outputPath, fullPage: false });
    await browser.close();
    console.log(`Screenshot saved to ${outputPath}`);
})();
