# User Deletion Strategy

This document outlines how user deletion is implemented in the Fire5 application. 
We use a hybrid approach combining database-level cascades and application-level logic
to ensure complete and consistent data removal.

## Database-Level Cascades

The following related entities are automatically deleted at the database level when a user is deleted:

| Entity | Table                    | Relationship | Notes |
|--------|--------------------------|--------------|-------|
| Address | `addresses`              | One-to-One   | User address |
| Files | `files`                  | One-to-Many  | Database records only |
| Contact User Relationships | `contact_user`           | Pivot Table  | Only the relationships, not the contacts |

## Application-Level Handling

The following operations are handled at the application level in the User model's `deleting` event:

1. **File Storage Cleanup**: Physical files are removed from the storage system
2. **Orphaned Contacts**: Contacts that were only associated with the deleted user are also deleted
3. **Custom Event**: A `UserDeleted` event is fired to allow other parts of the application to respond

## Why This Approach?

We chose this hybrid approach for:

1. **Data Integrity**: Database cascades ensure no orphaned records remain
2. **Performance**: Database operations handle bulk deletions efficiently
3. **Flexibility**: Application logic allows for complex operations like storage cleanup
4. **Maintainability**: Clear separation between database constraints and business logic

## Making Changes

If you need to modify the deletion behavior:

1. **For simple relationships**: Add them to the cascade migration pattern
2. **For complex operations**: Add them to the User model's `deleting` event handler
3. **For external system integrations**: Create a listener for the `UserDeleted` event

## Compliance Notes

This implementation supports GDPR compliance by completely removing user data upon deletion.
For audit purposes, consider adding a pre-deletion logging mechanism before modifying this strategy.

## Last Updated

7 May 2025

## Responsible Developers

Gaspare Joubert
