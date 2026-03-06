# Plan: Nâng cấp Nền tảng CIC CMS (Platform Migration)
Created: 2026-03-06T14:42:36+07:00
Status: 🟡 In Progress

## Overview
Dự án nhằm thay thế hệ thống website cũ chạy PHP thuần (vốn đang gặp nhiều vấn đề về bảo mật, chèn mã độc SEO, và code khó bảo trì) bằng một kiến trúc Headless CMS hiện đại. Mục đích chính là giữ nguyên giao diện UI/UX hiện tại (có cải tiến mượt mà hơn) trong khi loại bỏ hoàn toàn các rủi ro bảo mật từ hệ thống cũ.

## Tech Stack
- **Kiến trúc:** Headless CMS (Tách biệt hoàn toàn Client và Admin)
- **Frontend (Client):** Next.js (React) - Đảm bảo tốc độ nhanh nhất và SEO tốt nhất (Server-Side Rendering/Static Site Generation).
- **Backend (CMS/API):** Strapi (Node.js) hoặc Supabase - Tập trung vào việc cung cấp API và trang quản trị trực quan, an toàn.
- **Database:** PostgreSQL hoặc MySQL.
- **Deployment:** Vercel (Frontend) + VPS hiện hành (Backend).

## Luồng hoạt động cơ bản
1. **Khách truy cập:** Vào website -> Next.js phục vụ trang HTML cực nhanh -> Có thể gọi API để lấy dữ liệu mới nếu cần.
2. **Admin/Biên tập viên:** Đăng nhập vào trang quản trị CMS riêng biệt (auth siêu bảo mật) -> Soạn thảo & Quản lý bài viết/gói thầu. CMS sẽ cung cấp API cho Frontend.

## Phases

| Phase | Name | Status | Progress |
|-------|------|--------|----------|
| 01 | Setup Environment & Tech Stack | ⬜ Pending | 0% |
| 02 | Database Schema & Data Mapping | ⬜ Pending | 0% |
| 03 | Backend CMS Setup (API) | ⬜ Pending | 0% |
| 04 | Frontend UI (Clone & Polish) | ⬜ Pending | 0% |
| 05 | Data Migration (Script) | ⬜ Pending | 0% |
| 06 | Integration & SEO Transfer | ⬜ Pending | 0% |
| 07 | Testing & Go-Live | ⬜ Pending | 0% |

## Quick Commands
- Start Phase 1: `/code phase-01`
- Check progress: `/next`
- UI Design: `/visualize`
