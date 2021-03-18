/****** Script for SelectTopNRows command from SSMS  ******/
SELECT TOP (1000) [EmployeeID]
      ,[LastName]
      ,[FirstName]
      ,[Title]
  FROM [Northwind].[dbo].[Employees]
  FOR XML PATH('EMPLOYEE'),ROOT('EMPLOYEES')