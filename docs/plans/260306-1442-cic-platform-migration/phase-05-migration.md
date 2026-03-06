# Phase 05: Data Migration (Script ETL)
Status: ⬜ Pending
Dependencies: Phase 02, Phase 03

## Objective
Viết script tự động để Extract (rút) dữ liệu từ Database cũ, Transform (làm sạch/xử lý HTML rác, chuyển đổi path ảnh) và Load (nhúng) vào Database CMS mới. Cực kỳ cẩn thận không để sót data.

## Requirements
### Functional
- [ ] Migrate Categories (fs_categories, fs_products_categories).
- [ ] Migrate Posts (fs_news) cùng Relationships.
- [ ] Migrate Users (fs_users).
- [ ] Tool Regex: Thay thế Image URL cũ từ `<img src="/images/xxx">` thành URL chuẩn của hệ thống lưu trữ mới.

## Implementation Steps
1. [ ] Step 1 - Viết file Node.js script độc lập: `script/migrate-data.js`.
2. [ ] Step 2 - Khởi tạo kết nối 2 luồng: DB MySQL cũ (đọc) và CMS API mới (ghi).
3. [ ] Step 3 - Kéo danh mục (thực hiện đầu tiên để giữ ID mapping). Kéo tin tức theo từng lô (batch) 50 bài/lần để không time out.

## Test Criteria
- [ ] Check DB mới số lượng Record khớp với DB cũ. Không mất ảnh đính kèm trong bài viết cũ.

---
Next Phase: Phase 06 - Integration & SEO Transfer
