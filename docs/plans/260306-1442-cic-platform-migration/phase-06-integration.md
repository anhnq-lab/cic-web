# Phase 06: Integration & SEO Transfer
Status: ⬜ Pending
Dependencies: Phase 04, Phase 05

## Objective
Đây là Phase sống còn của CIC. Đảm bảo toàn bộ link Google đã index nhiều năm không bị chết.

## Requirements
### Functional
- [ ] Tạo file `next.config.js` chứa hàng rào 301 Redirects khổng lồ ánh xạ từ URL System (cũ) -> URL Slug (mới).
Ví dụ: `/?module=news&view=detail&id=123` -> `/tin-tuc/bai-viet-123`.

## Implementation Steps
1. [ ] Step 1 - Chạy công cụ cào (Crawl) link cũ. 
2. [ ] Step 2 - Ánh xạ trong mapping redirect.
3. [ ] Step 3 - Tạo Sitemap.xml và file Robots.txt mới.

## Test Criteria
- [ ] Click thử một link đang ở Top 1 Google của CIC, trình duyệt phải lập tức load về giao diện mới đúng nội dung.

---
Next Phase: Phase 07 - Testing & Go-Live
