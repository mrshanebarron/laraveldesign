import { chromium } from 'playwright';

const url = process.argv[2] || 'http://laraveldesign.test/admin';
const outputPath = process.argv[3] || 'screenshot.png';

(async () => {
    const browser = await chromium.launch({ headless: true });
    const page = await browser.newPage({ viewport: { width: 1400, height: 900 } });
    await page.goto(url, { waitUntil: 'networkidle', timeout: 30000 });
    await page.screenshot({ path: outputPath, fullPage: false });
    await browser.close();
    console.log(`Screenshot saved to ${outputPath}`);
})();
