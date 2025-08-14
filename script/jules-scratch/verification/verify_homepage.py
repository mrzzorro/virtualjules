from playwright.sync_api import sync_playwright, expect
import sys

def run_verification():
    with sync_playwright() as p:
        browser = p.chromium.launch(headless=True)
        page = browser.new_page()

        try:
            page.goto("http://localhost:3000")
            expect(page.get_by_role("heading", name="Latest Videos")).to_be_visible(timeout=20000)
            video_cards = page.locator('.card')
            expect(video_cards.first).to_be_visible(timeout=15000)
            page.screenshot(path="jules-scratch/verification/homepage.png")
            print("Verification script ran successfully.")
        except Exception as e:
            print(f"An error occurred: {e}", file=sys.stderr)
            page.screenshot(path="jules-scratch/verification/error.png")
            sys.exit(1)
        finally:
            browser.close()

if __name__ == "__main__":
    run_verification()
