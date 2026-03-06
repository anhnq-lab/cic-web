# Phase 01: Setup Environment & Tech Stack
Status: ⬜ Pending
Dependencies: None

## Objective
Khởi tạo cấu trúc thư mục cho dự án mới, cài đặt bộ khung cho cả Frontend (Next.js) và Backend (CMS).

## Requirements
### Functional
- [ ] Khởi tạo thư mục dự án Frontend dùng Next.js (App Router).
- [ ] Khởi tạo thư mục dự án Backend CMS (Strapi/Supabase).
- [ ] Cấu hình ESLint, Prettier cho Frontend để code chuẩn chỉ.

### Non-Functional
- [ ] Đảm bảo cấu trúc Git rõ ràng (monorepo hoặc 2 repo riêng).

## Implementation Steps
1. [ ] Step 1 - Tạo repo/thư mục root chứa cả Frontend và Backend.
2. [ ] Step 2 - Chạy lệnh `npx create-next-app@latest` để tạo Frontend.
3. [ ] Step 3 - Cài đặt Tailwind CSS (nếu chưa có) và các config UI/UX chuẩn AWF (ui-ux-pro-max).
4. [ ] Step 4 - Khởi tạo project Backend.

## Files to Create/Modify
- `frontend/package.json` - Setup Next.js
- `backend/package.json` - Setup CMS

## Test Criteria
- [ ] Gõ `npm run dev` ở Frontend hiển thị trang chủ mặc định của Next.js.
- [ ] Gõ `npm run develop` ở Backend truy cập được trang quản trị Admin.

---
Next Phase: Phase 02 - Database Schema & Data Mapping
