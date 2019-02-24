<?php $__env->startSection('content'); ?>
<v-app id="login" class="primary">
    <v-content>
        <v-container fluid fill-height>
            <v-layout align-center justify-center>
                <v-flex xs12 sm8 md4 lg4>
                    <v-card class="elevation-1 pa-5">
                        <div class="layout column align-center">
                            <img src="/img/logo.png" alt="Vue Material Admin" width="120" height="120">
                            <h1 class="flex my-4 primary--text">BRAMS 2.0</h1>
                        </div>
                        <v-form method="POST" action="<?php echo e(route('login')); ?>">
                            <?php echo csrf_field(); ?>
                            <v-text-field append-icon="person" name="username" placeholder="Username" class="form-control<?php echo e($errors->has('username') ? ' is-invalid' : ''); ?>" required></v-text-field>
                            
                            <v-text-field append-icon="lock" name="password" type="password" placeholder="Password" required></v-text-field>
                            
                            
                            <v-card-actions>
                                <v-checkbox name="remember" id="remember"
                                <?php echo e(old('remember') ? 'checked' : ''); ?> label="Remember me"></v-checkbox>
                                <v-spacer></v-spacer>
                                <a class="btn" href="<?php echo e(route('password.request')); ?>">
                                    Forgot Password</a>
                            </v-card-actions>
                            <v-btn block type="submit" color="primary">Login</v-btn>
                        </v-form>

                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
    </v-content>
    </div>
</v-app>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>