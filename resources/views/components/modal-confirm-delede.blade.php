<flux:modal name="modal-confirm-delete" class="min-w-[22rem] modal-container">
    <div class="space-y-6">
        <div>
            <flux:heading class="modal-title">Excluir registro?</flux:heading>
            
            <flux:text class="mt-2">
                <p class="modal-text">Você está prestes a excluir este registro.</p>
                <p class="modal-text">Esta ação não pode ser revertida.</p>
            </flux:text>
        </div>
        
        <div class="btn-container">
            <flux:spacer />
            
            <flux:modal.close>
                <flux:button class="btn btn-tertiary btn-tertiary-dark">Cancelar</flux:button>
            </flux:modal.close>
            
            <flux:button type="submit" class="btn btn-primary btn-danger">Excluir</flux:button>
        </div>
    </div>
</flux:modal>